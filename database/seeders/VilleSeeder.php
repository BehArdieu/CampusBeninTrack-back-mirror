<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    public function run(): void
    {
        $villes = [
            // Île-de-France
            ['ville' => 'Paris', 'latitude' => '48.8566', 'longitude' => '2.3522'],
            ['ville' => 'Boulogne-Billancourt', 'latitude' => '48.8352', 'longitude' => '2.2400'],
            ['ville' => 'Saint-Denis', 'latitude' => '48.9362', 'longitude' => '2.3574'],
            ['ville' => 'Argenteuil', 'latitude' => '48.9472', 'longitude' => '2.2467'],
            ['ville' => 'Montreuil', 'latitude' => '48.8638', 'longitude' => '2.4481'],
            ['ville' => 'Versailles', 'latitude' => '48.8014', 'longitude' => '2.1301'],
            ['ville' => 'Créteil', 'latitude' => '48.7904', 'longitude' => '2.4553'],
            ['ville' => 'Nanterre', 'latitude' => '48.8924', 'longitude' => '2.2071'],
            ['ville' => 'Vitry-sur-Seine', 'latitude' => '48.7871', 'longitude' => '2.4028'],
            ['ville' => 'Colombes', 'latitude' => '48.9224', 'longitude' => '2.2571'],
            ['ville' => 'Asnières-sur-Seine', 'latitude' => '48.9153', 'longitude' => '2.2852'],
            ['ville' => 'Courbevoie', 'latitude' => '48.8974', 'longitude' => '2.2527'],
            ['ville' => 'Rueil-Malmaison', 'latitude' => '48.8762', 'longitude' => '2.1889'],
            ['ville' => 'Champigny-sur-Marne', 'latitude' => '48.8162', 'longitude' => '2.5154'],
            ['ville' => 'Saint-Maur-des-Fossés', 'latitude' => '48.7967', 'longitude' => '2.4991'],
            ['ville' => 'Aubervilliers', 'latitude' => '48.9141', 'longitude' => '2.3834'],
            ['ville' => 'Ivry-sur-Seine', 'latitude' => '48.8143', 'longitude' => '2.3841'],
            ['ville' => 'Clichy', 'latitude' => '48.9038', 'longitude' => '2.3058'],
            ['ville' => 'Vincennes', 'latitude' => '48.8477', 'longitude' => '2.4391'],
            ['ville' => 'Aulnay-sous-Bois', 'latitude' => '48.9395', 'longitude' => '2.4949'],
            ['ville' => 'Évry-Courcouronnes', 'latitude' => '48.6324', 'longitude' => '2.4427'],
            ['ville' => 'Massy', 'latitude' => '48.7255', 'longitude' => '2.2700'],
            ['ville' => 'Cergy', 'latitude' => '49.0361', 'longitude' => '2.0631'],
            ['ville' => 'Pontoise', 'latitude' => '49.0506', 'longitude' => '2.1007'],
            ['ville' => 'Melun', 'latitude' => '48.5404', 'longitude' => '2.6562'],

            // Auvergne-Rhône-Alpes
            ['ville' => 'Lyon', 'latitude' => '45.7640', 'longitude' => '4.8357'],
            ['ville' => 'Grenoble', 'latitude' => '45.1885', 'longitude' => '5.7245'],
            ['ville' => 'Saint-Étienne', 'latitude' => '45.4397', 'longitude' => '4.3872'],
            ['ville' => 'Villeurbanne', 'latitude' => '45.7714', 'longitude' => '4.8890'],
            ['ville' => 'Clermont-Ferrand', 'latitude' => '45.7797', 'longitude' => '3.0863'],
            ['ville' => 'Annecy', 'latitude' => '45.8992', 'longitude' => '6.1294'],
            ['ville' => 'Chambéry', 'latitude' => '45.5646', 'longitude' => '5.9178'],
            ['ville' => 'Valence', 'latitude' => '44.9334', 'longitude' => '4.8924'],
            ['ville' => 'Annonay', 'latitude' => '45.2394', 'longitude' => '4.6694'],
            ['ville' => 'Bourg-en-Bresse', 'latitude' => '46.2051', 'longitude' => '5.2294'],
            ['ville' => 'Roanne', 'latitude' => '46.0340', 'longitude' => '4.0699'],
            ['ville' => 'Thonon-les-Bains', 'latitude' => '46.3708', 'longitude' => '6.4783'],
            ['ville' => 'Albertville', 'latitude' => '45.6754', 'longitude' => '6.3921'],
            ['ville' => 'Aurillac', 'latitude' => '44.9295', 'longitude' => '2.4418'],
            ['ville' => 'Montélimar', 'latitude' => '44.5562', 'longitude' => '4.7527'],
            ['ville' => 'Privas', 'latitude' => '44.7358', 'longitude' => '4.5993'],
            ['ville' => 'Le Puy-en-Velay', 'latitude' => '45.0433', 'longitude' => '3.8853'],
            ['ville' => 'Moulins', 'latitude' => '46.5644', 'longitude' => '3.3332'],
            ['ville' => 'Vichy', 'latitude' => '46.1278', 'longitude' => '3.4265'],

            // Provence-Alpes-Côte d'Azur
            ['ville' => 'Marseille', 'latitude' => '43.2965', 'longitude' => '5.3698'],
            ['ville' => 'Nice', 'latitude' => '43.7102', 'longitude' => '7.2620'],
            ['ville' => 'Toulon', 'latitude' => '43.1242', 'longitude' => '5.9280'],
            ['ville' => 'Aix-en-Provence', 'latitude' => '43.5297', 'longitude' => '5.4474'],
            ['ville' => 'Avignon', 'latitude' => '43.9493', 'longitude' => '4.8055'],
            ['ville' => 'Antibes', 'latitude' => '43.5804', 'longitude' => '7.1282'],
            ['ville' => 'Cannes', 'latitude' => '43.5528', 'longitude' => '7.0174'],
            ['ville' => 'La Seyne-sur-Mer', 'latitude' => '43.1010', 'longitude' => '5.8807'],
            ['ville' => 'Fréjus', 'latitude' => '43.4329', 'longitude' => '6.7369'],
            ['ville' => 'Gap', 'latitude' => '44.5594', 'longitude' => '6.0773'],
            ['ville' => 'Arles', 'latitude' => '43.6767', 'longitude' => '4.6278'],
            ['ville' => 'Martigues', 'latitude' => '43.4046', 'longitude' => '5.0486'],
            ['ville' => 'Digne-les-Bains', 'latitude' => '44.0921', 'longitude' => '6.2360'],

            // Occitanie
            ['ville' => 'Toulouse', 'latitude' => '43.6047', 'longitude' => '1.4442'],
            ['ville' => 'Montpellier', 'latitude' => '43.6108', 'longitude' => '3.8767'],
            ['ville' => 'Nîmes', 'latitude' => '43.8367', 'longitude' => '4.3601'],
            ['ville' => 'Perpignan', 'latitude' => '42.6986', 'longitude' => '2.8956'],
            ['ville' => 'Narbonne', 'latitude' => '43.1836', 'longitude' => '3.0036'],
            ['ville' => 'Alès', 'latitude' => '44.1253', 'longitude' => '4.0822'],
            ['ville' => 'Béziers', 'latitude' => '43.3441', 'longitude' => '3.2151'],
            ['ville' => 'Sète', 'latitude' => '43.4033', 'longitude' => '3.6966'],
            ['ville' => 'Montauban', 'latitude' => '44.0174', 'longitude' => '1.3527'],
            ['ville' => 'Albi', 'latitude' => '43.9296', 'longitude' => '2.1487'],
            ['ville' => 'Castres', 'latitude' => '43.6054', 'longitude' => '2.2462'],
            ['ville' => 'Carcassonne', 'latitude' => '43.2130', 'longitude' => '2.3491'],
            ['ville' => 'Cahors', 'latitude' => '44.4481', 'longitude' => '1.4412'],
            ['ville' => 'Tarbes', 'latitude' => '43.2328', 'longitude' => '0.0781'],
            ['ville' => 'Pau', 'latitude' => '43.2951', 'longitude' => '-0.3708'],
            ['ville' => 'Rodez', 'latitude' => '44.3506', 'longitude' => '2.5752'],
            ['ville' => 'Foix', 'latitude' => '42.9638', 'longitude' => '1.6059'],
            ['ville' => 'Auch', 'latitude' => '43.6462', 'longitude' => '0.5856'],
            ['ville' => 'Mende', 'latitude' => '44.5196', 'longitude' => '3.4985'],

            // Nouvelle-Aquitaine
            ['ville' => 'Bordeaux', 'latitude' => '44.8378', 'longitude' => '-0.5792'],
            ['ville' => 'Limoges', 'latitude' => '45.8336', 'longitude' => '1.2611'],
            ['ville' => 'Poitiers', 'latitude' => '46.5802', 'longitude' => '0.3404'],
            ['ville' => 'Bayonne', 'latitude' => '43.4929', 'longitude' => '-1.4748'],
            ['ville' => 'Pessac', 'latitude' => '44.8062', 'longitude' => '-0.6313'],
            ['ville' => 'Mérignac', 'latitude' => '44.8306', 'longitude' => '-0.6433'],
            ['ville' => 'Angoulême', 'latitude' => '45.6500', 'longitude' => '0.1564'],
            ['ville' => 'La Rochelle', 'latitude' => '46.1591', 'longitude' => '-1.1520'],
            ['ville' => 'Niort', 'latitude' => '46.3230', 'longitude' => '-0.4643'],
            ['ville' => 'Rochefort', 'latitude' => '45.9407', 'longitude' => '-0.9597'],
            ['ville' => 'Périgueux', 'latitude' => '45.1859', 'longitude' => '0.7217'],
            ['ville' => 'Brive-la-Gaillarde', 'latitude' => '45.1583', 'longitude' => '1.5328'],
            ['ville' => 'Tulle', 'latitude' => '45.2671', 'longitude' => '1.7725'],
            ['ville' => 'Agen', 'latitude' => '44.2004', 'longitude' => '0.6242'],
            ['ville' => 'Mont-de-Marsan', 'latitude' => '43.8894', 'longitude' => '-0.4965'],
            ['ville' => 'Dax', 'latitude' => '43.7097', 'longitude' => '-1.0539'],
            ['ville' => 'Guéret', 'latitude' => '46.1711', 'longitude' => '1.8712'],
            ['ville' => 'Châteauroux', 'latitude' => '46.8115', 'longitude' => '1.6912'],

            // Pays de la Loire
            ['ville' => 'Nantes', 'latitude' => '47.2184', 'longitude' => '-1.5536'],
            ['ville' => 'Angers', 'latitude' => '47.4784', 'longitude' => '-0.5632'],
            ['ville' => 'Le Mans', 'latitude' => '48.0061', 'longitude' => '0.1996'],
            ['ville' => 'Saint-Nazaire', 'latitude' => '47.2736', 'longitude' => '-2.2137'],
            ['ville' => 'La Roche-sur-Yon', 'latitude' => '46.6704', 'longitude' => '-1.4264'],
            ['ville' => 'Laval', 'latitude' => '48.0732', 'longitude' => '-0.7706'],
            ['ville' => 'Saint-Herblain', 'latitude' => '47.2168', 'longitude' => '-1.6497'],
            ['ville' => 'Cholet', 'latitude' => '47.0594', 'longitude' => '-0.8793'],
            ['ville' => 'Les Sables-d\'Olonne', 'latitude' => '46.4967', 'longitude' => '-1.7836'],

            // Bretagne
            ['ville' => 'Rennes', 'latitude' => '48.1173', 'longitude' => '-1.6778'],
            ['ville' => 'Brest', 'latitude' => '48.3905', 'longitude' => '-4.4860'],
            ['ville' => 'Quimper', 'latitude' => '47.9973', 'longitude' => '-4.0976'],
            ['ville' => 'Lorient', 'latitude' => '47.7482', 'longitude' => '-3.3702'],
            ['ville' => 'Vannes', 'latitude' => '47.6559', 'longitude' => '-2.7604'],
            ['ville' => 'Saint-Brieuc', 'latitude' => '48.5140', 'longitude' => '-2.7653'],
            ['ville' => 'Saint-Malo', 'latitude' => '48.6492', 'longitude' => '-2.0258'],

            // Normandie
            ['ville' => 'Rouen', 'latitude' => '49.4432', 'longitude' => '1.0993'],
            ['ville' => 'Caen', 'latitude' => '49.1829', 'longitude' => '-0.3707'],
            ['ville' => 'Le Havre', 'latitude' => '49.4944', 'longitude' => '0.1079'],
            ['ville' => 'Cherbourg-en-Cotentin', 'latitude' => '49.6337', 'longitude' => '-1.6228'],
            ['ville' => 'Évreux', 'latitude' => '49.0280', 'longitude' => '1.1513'],
            ['ville' => 'Alençon', 'latitude' => '48.4316', 'longitude' => '0.0914'],

            // Hauts-de-France
            ['ville' => 'Lille', 'latitude' => '50.6292', 'longitude' => '3.0573'],
            ['ville' => 'Amiens', 'latitude' => '49.8942', 'longitude' => '2.2958'],
            ['ville' => 'Dunkerque', 'latitude' => '51.0343', 'longitude' => '2.3769'],
            ['ville' => 'Roubaix', 'latitude' => '50.6942', 'longitude' => '3.1746'],
            ['ville' => 'Tourcoing', 'latitude' => '50.7233', 'longitude' => '3.1619'],
            ['ville' => 'Valenciennes', 'latitude' => '50.3560', 'longitude' => '3.5236'],
            ['ville' => 'Calais', 'latitude' => '50.9513', 'longitude' => '1.8587'],
            ['ville' => 'Maubeuge', 'latitude' => '50.2797', 'longitude' => '3.9730'],
            ['ville' => 'Arras', 'latitude' => '50.2918', 'longitude' => '2.7810'],
            ['ville' => 'Douai', 'latitude' => '50.3717', 'longitude' => '3.0797'],
            ['ville' => 'Compiègne', 'latitude' => '49.4183', 'longitude' => '2.8263'],
            ['ville' => 'Laon', 'latitude' => '49.5638', 'longitude' => '3.6242'],
            ['ville' => 'Beauvais', 'latitude' => '49.4303', 'longitude' => '2.0952'],

            // Grand Est
            ['ville' => 'Strasbourg', 'latitude' => '48.5734', 'longitude' => '7.7521'],
            ['ville' => 'Reims', 'latitude' => '49.2583', 'longitude' => '4.0317'],
            ['ville' => 'Metz', 'latitude' => '49.1193', 'longitude' => '6.1757'],
            ['ville' => 'Nancy', 'latitude' => '48.6921', 'longitude' => '6.1844'],
            ['ville' => 'Mulhouse', 'latitude' => '47.7508', 'longitude' => '7.3359'],
            ['ville' => 'Colmar', 'latitude' => '48.0793', 'longitude' => '7.3585'],
            ['ville' => 'Troyes', 'latitude' => '48.2973', 'longitude' => '4.0744'],
            ['ville' => 'Charleville-Mézières', 'latitude' => '49.7714', 'longitude' => '4.7191'],
            ['ville' => 'Épinal', 'latitude' => '48.1740', 'longitude' => '6.4494'],
            ['ville' => 'Thionville', 'latitude' => '49.3583', 'longitude' => '6.1689'],
            ['ville' => 'Forbach', 'latitude' => '49.1865', 'longitude' => '6.9006'],
            ['ville' => 'Hagondange', 'latitude' => '49.2489', 'longitude' => '6.1587'],
            ['ville' => 'Châlons-en-Champagne', 'latitude' => '48.9570', 'longitude' => '4.3631'],
            ['ville' => 'Chaumont', 'latitude' => '48.1130', 'longitude' => '5.1393'],
            ['ville' => 'Bar-le-Duc', 'latitude' => '48.7729', 'longitude' => '5.1617'],

            // Bourgogne-Franche-Comté
            ['ville' => 'Dijon', 'latitude' => '47.3220', 'longitude' => '5.0415'],
            ['ville' => 'Besançon', 'latitude' => '47.2380', 'longitude' => '6.0243'],
            ['ville' => 'Belfort', 'latitude' => '47.6383', 'longitude' => '6.8628'],
            ['ville' => 'Chalon-sur-Saône', 'latitude' => '46.7806', 'longitude' => '4.8521'],
            ['ville' => 'Mâcon', 'latitude' => '46.3052', 'longitude' => '4.8283'],
            ['ville' => 'Montbéliard', 'latitude' => '47.5101', 'longitude' => '6.7989'],
            ['ville' => 'Auxerre', 'latitude' => '47.7979', 'longitude' => '3.5671'],
            ['ville' => 'Nevers', 'latitude' => '46.9895', 'longitude' => '3.1572'],
            ['ville' => 'Lons-le-Saunier', 'latitude' => '46.6760', 'longitude' => '5.5527'],
            ['ville' => 'Vesoul', 'latitude' => '47.6227', 'longitude' => '6.1586'],

            // Centre-Val de Loire
            ['ville' => 'Tours', 'latitude' => '47.3941', 'longitude' => '0.6848'],
            ['ville' => 'Orléans', 'latitude' => '47.9029', 'longitude' => '1.9090'],
            ['ville' => 'Bourges', 'latitude' => '47.0818', 'longitude' => '2.3986'],
            ['ville' => 'Blois', 'latitude' => '47.5860', 'longitude' => '1.3359'],
            ['ville' => 'Chartres', 'latitude' => '48.4469', 'longitude' => '1.4875'],
            ['ville' => 'Châteauroux', 'latitude' => '46.8115', 'longitude' => '1.6912'],

            // Corse
            ['ville' => 'Ajaccio', 'latitude' => '41.9192', 'longitude' => '8.7386'],
            ['ville' => 'Bastia', 'latitude' => '42.7025', 'longitude' => '9.4502'],
            ['ville' => 'Porto-Vecchio', 'latitude' => '41.5917', 'longitude' => '9.2792'],
            ['ville' => 'Corte', 'latitude' => '42.3037', 'longitude' => '9.1497'],

            // DOM-TOM
            ['ville' => 'Saint-Denis (La Réunion)', 'latitude' => '-20.8823', 'longitude' => '55.4504'],
            ['ville' => 'Fort-de-France', 'latitude' => '14.6037', 'longitude' => '-61.0686'],
            ['ville' => 'Cayenne', 'latitude' => '4.9224', 'longitude' => '-52.3135'],
            ['ville' => 'Pointe-à-Pitre', 'latitude' => '16.2415', 'longitude' => '-61.5331'],
            ['ville' => 'Mamoudzou', 'latitude' => '-12.7806', 'longitude' => '45.2278'],
        ];

        DB::table('villes')->insertOrIgnore(
            array_map(fn($v) => array_merge($v, [
                'created_at' => now(),
                'updated_at' => now(),
            ]), $villes)
        );
    }
}
