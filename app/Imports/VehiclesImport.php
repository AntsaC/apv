<?php

namespace App\Imports;

use App\Enum\CivilityType;
use App\Enum\CustomerType;
use App\Enum\EnergyType;
use App\Enum\EventOrigin;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class VehiclesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $businessAccount = null;
        $eventAccount = null;
        $lastEventAccount = null;

        if ($row['compte_affaire']) {
            $businessAccount = Account::firstOrCreate([
                'label' => $row['compte_affaire']
            ]);    
        }

        if ($row['compte_evenement_veh']) {
            $eventAccount = Account::firstOrCreate([
                'label' => $row['compte_evenement_veh']
            ]);
        }
        
        if ($row['compte_dernier_evenement_veh']) {
            $lastEventAccount = Account::firstOrCreate([
                'label' => $row['compte_dernier_evenement_veh']
            ]);
        }
        
        $type = $row['type_de_prospect']; 
        if ($type === 'PARTICULIER') {
            $type = CustomerType::INDIVIDUAL;
        } elseif ($type === 'SOCIETE') {
            $type = CustomerType::COMPANY;
        } else {
            $type = null;
        }


        $customer = Customer::firstOrCreate(
            ['cardNumber' => $row['numero_de_fiche']],
            [
                'firstName' => $row['prenom'],
                'civility'  => $row['libelle_civilite'],
                'postalCode'    => $row['code_postal'],
                'type'  => $type,
                'lastName'  => $row['nom'],
                'address'   => $row['n_et_nom_de_la_voie'],
                'additionnalAdress' => $row['complement_adresse_1'],
                'city' => $row['ville'],
                'homePhone' => $row['telephone_domicile'],
                'portablePhone' => $row['telephone_portable'],
                'jobPhone' => $row['telephone_job'],
                'email' => $row['email'],
                'business_account_id'   => $businessAccount?->id,
                'event_account_id'  => $eventAccount?->id,
                'last_event_account_id' => $lastEventAccount?->id
            ]
        );

        $vnSeller = null;
        $voSeller = null;
        $vnIntermediateSeller = null;

        if ($row['vendeur_vn']) {
            $vnSeller = Seller::firstOrCreate([
                'name'  => $row['vendeur_vn']
            ]);
        }

        if ($row['vendeur_vo']) {
            $voSeller = Seller::firstOrCreate([
                'name'  => $row['vendeur_vo']
            ]);
        }

        if ($row['intermediaire_de_vente_vn']) {
            $vnIntermediateSeller = Seller::firstOrCreate([
                'name'  => $row['intermediaire_de_vente_vn']
            ]);
        }

        return new Vehicle([
            'circulationDate' => isset($row['date_de_mise_en_circulation']) ? Date::excelToDateTimeObject($row['date_de_mise_en_circulation'])->format('Y-m-d') : null,
            'purchaseDate'  => isset($row['date_achat_date_de_livraison']) ? Date::excelToDateTimeObject($row['date_achat_date_de_livraison'])->format('Y-m-d') : null,
            'lastEventDate' => isset($row['date_dernier_evenement_veh']) ? Date::excelToDateTimeObject($row['date_dernier_evenement_veh'])->format('Y-m-d') : null,
            'brand' => $row['libelle_marque_mrq'],
            'model' => $row['libelle_modele_mod'],
            'version' => $row['version'],
            'vin' => $row['vin'],
            'immatriculation' => $row['immatriculation'],
            'kilometrage' => $row['kilometrage'],
            'energy' => $row['libelle_energie_energ'],
            'saleType' => $row['type_vn_vo'],
            'saleFileNumber' => $row['numero_de_dossier_vn_vo'],
            'eventDate' => isset($row['date_evenement_veh']) ? Date::excelToDateTimeObject($row['date_evenement_veh'])->format('Y-m-d') : null,
            'eventOrigin' => EventOrigin::createFromLabel($row['origine_evenement_veh']),
            'invoiceComment' => $row['commentaire_de_facturation_veh'],
            'vn_seller_id' => $vnSeller?->id,
            'vo_seller_id' => $voSeller?->id,
            'intermediate_seller_id' => $vnIntermediateSeller?->id,
            'customer_id' => $customer?->id
        ]);
    }
}
