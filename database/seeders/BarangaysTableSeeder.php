<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barangay;
use App\Models\City;

class BarangaysTableSeeder extends Seeder
{
    public function run()
    {
        if (City::count() === 0) {
            $this->command->error('No cities found! Run CitiesTableSeeder first.');
            return;
        }

        $barangays = [
            // Tagbilaran City (050201) - 3 sample barangays
            ['code' => '05020101', 'city_code' => '050201', 'name' => 'Bool'],
            ['code' => '05020102', 'city_code' => '050201', 'name' => 'Booy'],
            ['code' => '05020103', 'city_code' => '050201', 'name' => 'Cabawan'],

            // Alburquerque (050202) - 3 sample barangays
            ['code' => '05020201', 'city_code' => '050202', 'name' => 'Poblacion'],
            ['code' => '05020202', 'city_code' => '050202', 'name' => 'Bahi'],
            ['code' => '05020203', 'city_code' => '050202', 'name' => 'Basacdacu'],

            // Alicia (050203) - 3 sample barangays
            ['code' => '05020301', 'city_code' => '050203', 'name' => 'Poblacion'],
            ['code' => '05020302', 'city_code' => '050203', 'name' => 'Cabatang'],
            ['code' => '05020303', 'city_code' => '050203', 'name' => 'Cagongcagong'],

            // Anda (050204) - 3 sample barangays
            ['code' => '05020401', 'city_code' => '050204', 'name' => 'Poblacion'],
            ['code' => '05020402', 'city_code' => '050204', 'name' => 'Almaria'],
            ['code' => '05020403', 'city_code' => '050204', 'name' => 'Bacong'],

            // Antequera (050205) - 3 sample barangays
            ['code' => '05020501', 'city_code' => '050205', 'name' => 'Poblacion'],
            ['code' => '05020502', 'city_code' => '050205', 'name' => 'Angilan'],
            ['code' => '05020503', 'city_code' => '050205', 'name' => 'Bantolinao'],

            // Baclayon (050206) - 3 sample barangays
            ['code' => '05020601', 'city_code' => '050206', 'name' => 'Poblacion'],
            ['code' => '05020602', 'city_code' => '050206', 'name' => 'Campatoc'],
            ['code' => '05020603', 'city_code' => '050206', 'name' => 'Dasitam'],

            // Balilihan (050207) - 3 sample barangays
            ['code' => '05020701', 'city_code' => '050207', 'name' => 'Poblacion'],
            ['code' => '05020702', 'city_code' => '050207', 'name' => 'Baucan Norte'],
            ['code' => '05020703', 'city_code' => '050207', 'name' => 'Baoy'],

            // Batuan (050208) - 3 sample barangays
            ['code' => '05020801', 'city_code' => '050208', 'name' => 'Poblacion Norte'],
            ['code' => '05020802', 'city_code' => '050208', 'name' => 'Poblacion Sur'],
            ['code' => '05020803', 'city_code' => '050208', 'name' => 'Aloja'],

            // Bien Unido (050209) - 3 sample barangays
            ['code' => '05020901', 'city_code' => '050209', 'name' => 'Poblacion'],
            ['code' => '05020902', 'city_code' => '050209', 'name' => 'Bilangbilangan'],
            ['code' => '05020903', 'city_code' => '050209', 'name' => 'Hingotanan East'],

            // Bilar (050210) - 3 sample barangays
            ['code' => '05021001', 'city_code' => '050210', 'name' => 'Poblacion'],
            ['code' => '05021002', 'city_code' => '050210', 'name' => 'Bonifacio'],
            ['code' => '05021003', 'city_code' => '050210', 'name' => 'Bugang Norte'],

            // Buenavista (050211) - 3 sample barangays
            ['code' => '05021101', 'city_code' => '050211', 'name' => 'Poblacion'],
            ['code' => '05021102', 'city_code' => '050211', 'name' => 'Agong'],
            ['code' => '05021103', 'city_code' => '050211', 'name' => 'Albuhera'],

            // Calape (050212) - ALL BARANGAYS (33 barangays)
            ['code' => '05021201', 'city_code' => '050212', 'name' => 'Abucay'],
            ['code' => '05021202', 'city_code' => '050212', 'name' => 'Banlasan'],
            ['code' => '05021203', 'city_code' => '050212', 'name' => 'Bentig'],
            ['code' => '05021204', 'city_code' => '050212', 'name' => 'Binogawan'],
            ['code' => '05021205', 'city_code' => '050212', 'name' => 'Bonbon'],
            ['code' => '05021206', 'city_code' => '050212', 'name' => 'Cabayugan'],
            ['code' => '05021207', 'city_code' => '050212', 'name' => 'Cabudburan'],
            ['code' => '05021208', 'city_code' => '050212', 'name' => 'Calunasan Norte'],
            ['code' => '05021209', 'city_code' => '050212', 'name' => 'Calunasan Sur'],
            ['code' => '05021210', 'city_code' => '050212', 'name' => 'Camias'],
            ['code' => '05021211', 'city_code' => '050212', 'name' => 'Canguha'],
            ['code' => '05021212', 'city_code' => '050212', 'name' => 'Catmonan'],
            ['code' => '05021213', 'city_code' => '050212', 'name' => 'Desamparados'],
            ['code' => '05021214', 'city_code' => '050212', 'name' => 'Kahayag'],
            ['code' => '05021215', 'city_code' => '050212', 'name' => 'Kinabag-an'],
            ['code' => '05021216', 'city_code' => '050212', 'name' => 'Labuon'],
            ['code' => '05021217', 'city_code' => '050212', 'name' => 'Liboron'],
            ['code' => '05021218', 'city_code' => '050212', 'name' => 'Looc'],
            ['code' => '05021219', 'city_code' => '050212', 'name' => 'Macaas'],
            ['code' => '05021220', 'city_code' => '050212', 'name' => 'Matabao'],
            ['code' => '05021221', 'city_code' => '050212', 'name' => 'Moto Norte'],
            ['code' => '05021222', 'city_code' => '050212', 'name' => 'Moto Sur'],
            ['code' => '05021223', 'city_code' => '050212', 'name' => 'Ondol'],
            ['code' => '05021224', 'city_code' => '050212', 'name' => 'Poblacion'],
            ['code' => '05021225', 'city_code' => '050212', 'name' => 'Poblacion East'],
            ['code' => '05021226', 'city_code' => '050212', 'name' => 'Poblacion West'],
            ['code' => '05021227', 'city_code' => '050212', 'name' => 'Quinabigan'],
            ['code' => '05021228', 'city_code' => '050212', 'name' => 'San Isidro'],
            ['code' => '05021229', 'city_code' => '050212', 'name' => 'Santa Cruz'],
            ['code' => '05021230', 'city_code' => '050212', 'name' => 'Sohoton'],
            ['code' => '05021231', 'city_code' => '050212', 'name' => 'Tultugan'],
            ['code' => '05021232', 'city_code' => '050212', 'name' => 'Ulbojan'],
            ['code' => '05021233', 'city_code' => '050212', 'name' => 'Victory'],

            // Candijay (050213) - 3 sample barangays
            ['code' => '05021301', 'city_code' => '050213', 'name' => 'Poblacion'],
            ['code' => '05021302', 'city_code' => '050213', 'name' => 'Abihilan'],
            ['code' => '05021303', 'city_code' => '050213', 'name' => 'Anoling'],

            // Carmen (050214) - 3 sample barangays
            ['code' => '05021401', 'city_code' => '050214', 'name' => 'Poblacion'],
            ['code' => '05021402', 'city_code' => '050214', 'name' => 'Bicao'],
            ['code' => '05021403', 'city_code' => '050214', 'name' => 'Buenavista'],

            // Catigbian (050215) - 3 sample barangays
            ['code' => '05021501', 'city_code' => '050215', 'name' => 'Poblacion'],
            ['code' => '05021502', 'city_code' => '050215', 'name' => 'Ambuan'],
            ['code' => '05021503', 'city_code' => '050215', 'name' => 'Baang'],

            // Clarin (050216) - ALL BARANGAYS (24 barangays)
            ['code' => '05021601', 'city_code' => '050216', 'name' => 'Poblacion Centro'],
            ['code' => '05021602', 'city_code' => '050216', 'name' => 'Poblacion Norte'],
            ['code' => '05021603', 'city_code' => '050216', 'name' => 'Poblacion Sur'],
            ['code' => '05021604', 'city_code' => '050216', 'name' => 'Bacani'],
            ['code' => '05021605', 'city_code' => '050216', 'name' => 'Bogtongbod'],
            ['code' => '05021606', 'city_code' => '050216', 'name' => 'Bonbon'],
            ['code' => '05021607', 'city_code' => '050216', 'name' => 'Bontud'],
            ['code' => '05021608', 'city_code' => '050216', 'name' => 'Buacao'],
            ['code' => '05021609', 'city_code' => '050216', 'name' => 'Buangan'],
            ['code' => '05021610', 'city_code' => '050216', 'name' => 'Cabog'],
            ['code' => '05021611', 'city_code' => '050216', 'name' => 'Caboy'],
            ['code' => '05021612', 'city_code' => '050216', 'name' => 'Caluwasan'],
            ['code' => '05021613', 'city_code' => '050216', 'name' => 'Candajec'],
            ['code' => '05021614', 'city_code' => '050216', 'name' => 'Cantoyoc'],
            ['code' => '05021615', 'city_code' => '050216', 'name' => 'Comaang'],
            ['code' => '05021616', 'city_code' => '050216', 'name' => 'Danahao'],
            ['code' => '05021617', 'city_code' => '050216', 'name' => 'Katipunan'],
            ['code' => '05021618', 'city_code' => '050216', 'name' => 'Lajog'],
            ['code' => '05021619', 'city_code' => '050216', 'name' => 'Mataub'],
            ['code' => '05021620', 'city_code' => '050216', 'name' => 'Nahawan'],
            ['code' => '05021621', 'city_code' => '050216', 'name' => 'Pangapasan'],
            ['code' => '05021622', 'city_code' => '050216', 'name' => 'Pinayagan Norte'],
            ['code' => '05021623', 'city_code' => '050216', 'name' => 'Pinayagan Sur'],
            ['code' => '05021624', 'city_code' => '050216', 'name' => 'Tontunan'],

            // Corella (050217) - 3 sample barangays
            ['code' => '05021701', 'city_code' => '050217', 'name' => 'Poblacion'],
            ['code' => '05021702', 'city_code' => '050217', 'name' => 'Anislag'],
            ['code' => '05021703', 'city_code' => '050217', 'name' => 'Canangca-an'],

            // Cortes (050218) - 3 sample barangays
            ['code' => '05021801', 'city_code' => '050218', 'name' => 'Poblacion'],
            ['code' => '05021802', 'city_code' => '050218', 'name' => 'De la Paz'],
            ['code' => '05021803', 'city_code' => '050218', 'name' => 'Fatima'],

            // Dagohoy (050219) - 3 sample barangays
            ['code' => '05021901', 'city_code' => '050219', 'name' => 'Poblacion'],
            ['code' => '05021902', 'city_code' => '050219', 'name' => 'Cagawasan'],
            ['code' => '05021903', 'city_code' => '050219', 'name' => 'Cagawitan'],

            // Danao (050220) - 3 sample barangays
            ['code' => '05022001', 'city_code' => '050220', 'name' => 'Poblacion'],
            ['code' => '05022002', 'city_code' => '050220', 'name' => 'Cabatuan'],
            ['code' => '05022003', 'city_code' => '050220', 'name' => 'Cantubod'],

            // Dauis (050221) - 3 sample barangays
            ['code' => '05022101', 'city_code' => '050221', 'name' => 'Poblacion'],
            ['code' => '05022102', 'city_code' => '050221', 'name' => 'Mayacabac'],
            ['code' => '05022103', 'city_code' => '050221', 'name' => 'Songculan'],

            // Dimiao (050222) - 3 sample barangays
            ['code' => '05022201', 'city_code' => '050222', 'name' => 'Poblacion'],
            ['code' => '05022202', 'city_code' => '050222', 'name' => 'Ablan'],
            ['code' => '05022203', 'city_code' => '050222', 'name' => 'Bacawan'],

            // Duero (050223) - 3 sample barangays
            ['code' => '05022301', 'city_code' => '050223', 'name' => 'Poblacion'],
            ['code' => '05022302', 'city_code' => '050223', 'name' => 'Alemania'],
            ['code' => '05022303', 'city_code' => '050223', 'name' => 'Angilan'],

            // Garcia Hernandez (050224) - 3 sample barangays
            ['code' => '05022401', 'city_code' => '050224', 'name' => 'Poblacion'],
            ['code' => '05022402', 'city_code' => '050224', 'name' => 'Antipolo'],
            ['code' => '05022403', 'city_code' => '050224', 'name' => 'Basiao'],

            // Getafe (050225) - 3 sample barangays
            ['code' => '05022501', 'city_code' => '050225', 'name' => 'Poblacion'],
            ['code' => '05022502', 'city_code' => '050225', 'name' => 'Alumar'],
            ['code' => '05022503', 'city_code' => '050225', 'name' => 'Banlasan'],

            // Guindulman (050226) - 3 sample barangays
            ['code' => '05022601', 'city_code' => '050226', 'name' => 'Poblacion'],
            ['code' => '05022602', 'city_code' => '050226', 'name' => 'Basdio'],
            ['code' => '05022603', 'city_code' => '050226', 'name' => 'Bato'],

            // Inabanga (050227) - ALL BARANGAYS (50 barangays)
            ['code' => '05022701', 'city_code' => '050227', 'name' => 'Poblacion'],
            ['code' => '05022702', 'city_code' => '050227', 'name' => 'Anonang'],
            ['code' => '05022703', 'city_code' => '050227', 'name' => 'Bahan'],
            ['code' => '05022704', 'city_code' => '050227', 'name' => 'Badiang'],
            ['code' => '05022705', 'city_code' => '050227', 'name' => 'Baguhan'],
            ['code' => '05022706', 'city_code' => '050227', 'name' => 'Banahao'],
            ['code' => '05022707', 'city_code' => '050227', 'name' => 'Baogo'],
            ['code' => '05022708', 'city_code' => '050227', 'name' => 'Baybay'],
            ['code' => '05022709', 'city_code' => '050227', 'name' => 'Binuangan'],
            ['code' => '05022710', 'city_code' => '050227', 'name' => 'Bugho'],
            ['code' => '05022711', 'city_code' => '050227', 'name' => 'Cagawasan'],
            ['code' => '05022712', 'city_code' => '050227', 'name' => 'Cagayan'],
            ['code' => '05022713', 'city_code' => '050227', 'name' => 'Cambitoon'],
            ['code' => '05022714', 'city_code' => '050227', 'name' => 'Canlinte'],
            ['code' => '05022715', 'city_code' => '050227', 'name' => 'Cawayan'],
            ['code' => '05022716', 'city_code' => '050227', 'name' => 'Cogon'],
            ['code' => '05022717', 'city_code' => '050227', 'name' => 'Cuaming'],
            ['code' => '05022718', 'city_code' => '050227', 'name' => 'Dagnawan'],
            ['code' => '05022719', 'city_code' => '050227', 'name' => 'Dait Sur'],
            ['code' => '05022720', 'city_code' => '050227', 'name' => 'Datag'],
            ['code' => '05022721', 'city_code' => '050227', 'name' => 'Fatima'],
            ['code' => '05022722', 'city_code' => '050227', 'name' => 'Hambongan'],
            ['code' => '05022723', 'city_code' => '050227', 'name' => 'Ilaud'],
            ['code' => '05022724', 'city_code' => '050227', 'name' => 'Ilaya'],
            ['code' => '05022725', 'city_code' => '050227', 'name' => 'Ilihan'],
            ['code' => '05022726', 'city_code' => '050227', 'name' => 'Lapacan Norte'],
            ['code' => '05022727', 'city_code' => '050227', 'name' => 'Lapacan Sur'],
            ['code' => '05022728', 'city_code' => '050227', 'name' => 'Lawis'],
            ['code' => '05022729', 'city_code' => '050227', 'name' => 'Liloan Norte'],
            ['code' => '05022730', 'city_code' => '050227', 'name' => 'Liloan Sur'],
            ['code' => '05022731', 'city_code' => '050227', 'name' => 'Lomboy'],
            ['code' => '05022732', 'city_code' => '050227', 'name' => 'Lonoy'],
            ['code' => '05022733', 'city_code' => '050227', 'name' => 'Mabini'],
            ['code' => '05022734', 'city_code' => '050227', 'name' => 'Maribojoc'],
            ['code' => '05022735', 'city_code' => '050227', 'name' => 'Napo'],
            ['code' => '05022736', 'city_code' => '050227', 'name' => 'Ondol'],
            ['code' => '05022737', 'city_code' => '050227', 'name' => 'Pagina'],
            ['code' => '05022738', 'city_code' => '050227', 'name' => 'Poblacion'],
            ['code' => '05022739', 'city_code' => '050227', 'name' => 'Riverside'],
            ['code' => '05022740', 'city_code' => '050227', 'name' => 'Saa'],
            ['code' => '05022741', 'city_code' => '050227', 'name' => 'San Isidro'],
            ['code' => '05022742', 'city_code' => '050227', 'name' => 'San Jose'],
            ['code' => '05022743', 'city_code' => '050227', 'name' => 'San Juan'],
            ['code' => '05022744', 'city_code' => '050227', 'name' => 'San Vicente'],
            ['code' => '05022745', 'city_code' => '050227', 'name' => 'Santo Niño'],
            ['code' => '05022746', 'city_code' => '050227', 'name' => 'Socorro'],
            ['code' => '05022747', 'city_code' => '050227', 'name' => 'Taytay'],
            ['code' => '05022748', 'city_code' => '050227', 'name' => 'Tubod'],
            ['code' => '05022749', 'city_code' => '050227', 'name' => 'Ubay'],
            ['code' => '05022750', 'city_code' => '050227', 'name' => 'Utod'],

            // Continue with the remaining municipalities...
            // Jagna (050228) - 3 sample barangays
            ['code' => '05022801', 'city_code' => '050228', 'name' => 'Poblacion'],
            ['code' => '05022802', 'city_code' => '050228', 'name' => 'Alejandro'],
            ['code' => '05022803', 'city_code' => '050228', 'name' => 'Balili'],

            // Jetafe (050229) - 3 sample barangays
            ['code' => '05022901', 'city_code' => '050229', 'name' => 'Poblacion'],
            ['code' => '05022902', 'city_code' => '050229', 'name' => 'Banlasan'],
            ['code' => '05022903', 'city_code' => '050229', 'name' => 'Bongbong'],

            // Lila (050230) - 3 sample barangays
            ['code' => '05023001', 'city_code' => '050230', 'name' => 'Poblacion'],
            ['code' => '05023002', 'city_code' => '050230', 'name' => 'Bonkokan'],
            ['code' => '05023003', 'city_code' => '050230', 'name' => 'Calunasan'],

            // Loay (050231) - 3 sample barangays
            ['code' => '05023101', 'city_code' => '050231', 'name' => 'Poblacion'],
            ['code' => '05023102', 'city_code' => '050231', 'name' => 'Agape'],
            ['code' => '05023103', 'city_code' => '050231', 'name' => 'Basac'],

            // Loboc (050232) - 3 sample barangays
            ['code' => '05023201', 'city_code' => '050232', 'name' => 'Poblacion'],
            ['code' => '05023202', 'city_code' => '050232', 'name' => 'Agape'],
            ['code' => '05023203', 'city_code' => '050232', 'name' => 'Basac'],

            // Loon (050233) - ALL BARANGAYS (67 barangays)
            ['code' => '05023301', 'city_code' => '050233', 'name' => 'Poblacion'],
            ['code' => '05023302', 'city_code' => '050233', 'name' => 'Agujo'],
            ['code' => '05023303', 'city_code' => '050233', 'name' => 'Badbad'],
            ['code' => '05023304', 'city_code' => '050233', 'name' => 'Bagacay'],
            ['code' => '05023305', 'city_code' => '050233', 'name' => 'Bahaybahay'],
            ['code' => '05023306', 'city_code' => '050233', 'name' => 'Basac'],
            ['code' => '05023307', 'city_code' => '050233', 'name' => 'Basdacu'],
            ['code' => '05023308', 'city_code' => '050233', 'name' => 'Basdio'],
            ['code' => '05023309', 'city_code' => '050233', 'name' => 'Bato'],
            ['code' => '05023310', 'city_code' => '050233', 'name' => 'Bonbon'],
            ['code' => '05023311', 'city_code' => '050233', 'name' => 'Bongco'],
            ['code' => '05023312', 'city_code' => '050233', 'name' => 'Bugho'],
            ['code' => '05023313', 'city_code' => '050233', 'name' => 'Cabacongan'],
            ['code' => '05023314', 'city_code' => '050233', 'name' => 'Cabug'],
            ['code' => '05023315', 'city_code' => '050233', 'name' => 'Calayugan'],
            ['code' => '05023316', 'city_code' => '050233', 'name' => 'Cambaquiz'],
            ['code' => '05023317', 'city_code' => '050233', 'name' => 'Campatud'],
            ['code' => '05023318', 'city_code' => '050233', 'name' => 'Candaigan'],
            ['code' => '05023319', 'city_code' => '050233', 'name' => 'Canhangdon Occidental'],
            ['code' => '05023320', 'city_code' => '050233', 'name' => 'Canhangdon Oriental'],
            ['code' => '05023321', 'city_code' => '050233', 'name' => 'Canigaan'],
            ['code' => '05023322', 'city_code' => '050233', 'name' => 'Canmanoc'],
            ['code' => '05023323', 'city_code' => '050233', 'name' => 'Cansuagwit'],
            ['code' => '05023324', 'city_code' => '050233', 'name' => 'Cansubayon'],
            ['code' => '05023325', 'city_code' => '050233', 'name' => 'Catagbacan'],
            ['code' => '05023326', 'city_code' => '050233', 'name' => 'Cogon Norte'],
            ['code' => '05023327', 'city_code' => '050233', 'name' => 'Cogon Sur'],
            ['code' => '05023328', 'city_code' => '050233', 'name' => 'Cuasi'],
            ['code' => '05023329', 'city_code' => '050233', 'name' => 'Daan Norte'],
            ['code' => '05023330', 'city_code' => '050233', 'name' => 'Daan Sur'],
            ['code' => '05023331', 'city_code' => '050233', 'name' => 'Dugyan'],
            ['code' => '05023332', 'city_code' => '050233', 'name' => 'East Lourdes'],
            ['code' => '05023333', 'city_code' => '050233', 'name' => 'Fatima'],
            ['code' => '05023334', 'city_code' => '050233', 'name' => 'Gabas'],
            ['code' => '05023335', 'city_code' => '050233', 'name' => 'Gapas'],
            ['code' => '05023336', 'city_code' => '050233', 'name' => 'Genomoan'],
            ['code' => '05023337', 'city_code' => '050233', 'name' => 'Lintuan'],
            ['code' => '05023338', 'city_code' => '050233', 'name' => 'Loay'],
            ['code' => '05023339', 'city_code' => '050233', 'name' => 'Lomboy'],
            ['code' => '05023340', 'city_code' => '050233', 'name' => 'Lonoy'],
            ['code' => '05023341', 'city_code' => '050233', 'name' => 'Mocpoc Norte'],
            ['code' => '05023342', 'city_code' => '050233', 'name' => 'Mocpoc Sur'],
            ['code' => '05023343', 'city_code' => '050233', 'name' => 'Nagtuang'],
            ['code' => '05023344', 'city_code' => '050233', 'name' => 'Napo'],
            ['code' => '05023345', 'city_code' => '050233', 'name' => 'Pananquilon'],
            ['code' => '05023346', 'city_code' => '050233', 'name' => 'Pondol'],
            ['code' => '05023347', 'city_code' => '050233', 'name' => 'Quinobcoban'],
            ['code' => '05023348', 'city_code' => '050233', 'name' => 'Sondol'],
            ['code' => '05023349', 'city_code' => '050233', 'name' => 'Song-on'],
            ['code' => '05023350', 'city_code' => '050233', 'name' => 'Taytay'],
            ['code' => '05023351', 'city_code' => '050233', 'name' => 'Tigbao'],
            ['code' => '05023352', 'city_code' => '050233', 'name' => 'Tiguis'],
            ['code' => '05023353', 'city_code' => '050233', 'name' => 'Tubodacu'],
            ['code' => '05023354', 'city_code' => '050233', 'name' => 'Tubodio'],
            ['code' => '05023355', 'city_code' => '050233', 'name' => 'Tubuan'],
            ['code' => '05023356', 'city_code' => '050233', 'name' => 'West Lourdes'],
            ['code' => '05023357', 'city_code' => '050233', 'name' => 'Ytaya'],

            // Continue with the remaining municipalities...
            // Mabini (050234) - 3 sample barangays
            ['code' => '05023401', 'city_code' => '050234', 'name' => 'Poblacion I'],
            ['code' => '05023402', 'city_code' => '050234', 'name' => 'Poblacion II'],
            ['code' => '05023403', 'city_code' => '050234', 'name' => 'Aguipo'],

            // Maribojoc (050235) - 3 sample barangays
            ['code' => '05023501', 'city_code' => '050235', 'name' => 'Poblacion'],
            ['code' => '05023502', 'city_code' => '050235', 'name' => 'Agahay'],
            ['code' => '05023503', 'city_code' => '050235', 'name' => 'Aliguay'],

            // Panglao (050236) - 3 sample barangays
            ['code' => '05023601', 'city_code' => '050236', 'name' => 'Poblacion'],
            ['code' => '05023602', 'city_code' => '050236', 'name' => 'Danao'],
            ['code' => '05023603', 'city_code' => '050236', 'name' => 'Lourdes'],

            // Pilar (050237) - 3 sample barangays
            ['code' => '05023701', 'city_code' => '050237', 'name' => 'Poblacion'],
            ['code' => '05023702', 'city_code' => '050237', 'name' => 'Aurora'],
            ['code' => '05023703', 'city_code' => '050237', 'name' => 'Bagacay'],

            // President Carlos P. Garcia (050238) - 3 sample barangays
            ['code' => '05023801', 'city_code' => '050238', 'name' => 'Poblacion'],
            ['code' => '05023802', 'city_code' => '050238', 'name' => 'Butan'],
            ['code' => '05023803', 'city_code' => '050238', 'name' => 'Campamanog'],

            // Sagbayan (050239) - 3 sample barangays
            ['code' => '05023901', 'city_code' => '050239', 'name' => 'Poblacion'],
            ['code' => '05023902', 'city_code' => '050239', 'name' => 'Calangahan'],
            ['code' => '05023903', 'city_code' => '050239', 'name' => 'Canmano'],

            // San Isidro (050240) - 3 sample barangays
            ['code' => '05024001', 'city_code' => '050240', 'name' => 'Poblacion'],
            ['code' => '05024002', 'city_code' => '050240', 'name' => 'Baunos'],
            ['code' => '05024003', 'city_code' => '050240', 'name' => 'Cabanugan'],

            // San Miguel (050241) - 3 sample barangays
            ['code' => '05024101', 'city_code' => '050241', 'name' => 'Poblacion'],
            ['code' => '05024102', 'city_code' => '050241', 'name' => 'Bayongan'],
            ['code' => '05024103', 'city_code' => '050241', 'name' => 'Bugsoc'],

            // Sevilla (050242) - 3 sample barangays
            ['code' => '05024201', 'city_code' => '050242', 'name' => 'Poblacion'],
            ['code' => '05024202', 'city_code' => '050242', 'name' => 'Bayawahan'],
            ['code' => '05024203', 'city_code' => '050242', 'name' => 'Cabancalan'],

            // Sierra Bullones (050243) - 3 sample barangays
            ['code' => '05024301', 'city_code' => '050243', 'name' => 'Poblacion'],
            ['code' => '05024302', 'city_code' => '050243', 'name' => 'Abachanan'],
            ['code' => '05024303', 'city_code' => '050243', 'name' => 'Anibongan'],

            // Sikatuna (050244) - 3 sample barangays
            ['code' => '05024401', 'city_code' => '050244', 'name' => 'Poblacion'],
            ['code' => '05024402', 'city_code' => '050244', 'name' => 'Badiang'],
            ['code' => '05024403', 'city_code' => '050244', 'name' => 'Bahaybahay'],

            // Talibon (050245) - 3 sample barangays
            ['code' => '05024501', 'city_code' => '050245', 'name' => 'Poblacion'],
            ['code' => '05024502', 'city_code' => '050245', 'name' => 'Bagacay'],
            ['code' => '05024503', 'city_code' => '050245', 'name' => 'Balintawak'],

            // Trinidad (050246) - 3 sample barangays
            ['code' => '05024601', 'city_code' => '050246', 'name' => 'Poblacion'],
            ['code' => '05024602', 'city_code' => '050246', 'name' => 'Banlasan'],
            ['code' => '05024603', 'city_code' => '050246', 'name' => 'Bongbong'],

            // Tubigon (050247) - ALL BARANGAYS (34 barangays)
            ['code' => '05024701', 'city_code' => '050247', 'name' => 'Poblacion I'],
            ['code' => '05024702', 'city_code' => '050247', 'name' => 'Poblacion II'],
            ['code' => '05024703', 'city_code' => '050247', 'name' => 'Poblacion III'],
            ['code' => '05024704', 'city_code' => '050247', 'name' => 'Bagongbanwa'],
            ['code' => '05024705', 'city_code' => '050247', 'name' => 'Bunacan'],
            ['code' => '05024706', 'city_code' => '050247', 'name' => 'Banlasan'],
            ['code' => '05024707', 'city_code' => '050247', 'name' => 'Batasan (Batasan Island)'],
            ['code' => '05024708', 'city_code' => '050247', 'name' => 'Bilangbilangan'],
            ['code' => '05024709', 'city_code' => '050247', 'name' => 'Bosongon'],
            ['code' => '05024710', 'city_code' => '050247', 'name' => 'Buenavista'],
            ['code' => '05024711', 'city_code' => '050247', 'name' => 'Cayap Norte'],
            ['code' => '05024712', 'city_code' => '050247', 'name' => 'Cayap Sur'],
            ['code' => '05024713', 'city_code' => '050247', 'name' => 'Centro'],
            ['code' => '05024714', 'city_code' => '050247', 'name' => 'Genonocan'],
            ['code' => '05024715', 'city_code' => '050247', 'name' => 'Guiwanon'],
            ['code' => '05024716', 'city_code' => '050247', 'name' => 'Ilijan'],
            ['code' => '05024717', 'city_code' => '050247', 'name' => 'Imelda'],
            ['code' => '05024718', 'city_code' => '050247', 'name' => 'Panadtaran'],
            ['code' => '05024719', 'city_code' => '050247', 'name' => 'Panaytayon'],
            ['code' => '05024720', 'city_code' => '050247', 'name' => 'Pandan'],
            ['code' => '05024721', 'city_code' => '050247', 'name' => 'Pinayagan Norte'],
            ['code' => '05024722', 'city_code' => '050247', 'name' => 'Pinayagan Sur'],
            ['code' => '05024723', 'city_code' => '050247', 'name' => 'Pooc Occidental'],
            ['code' => '05024724', 'city_code' => '050247', 'name' => 'Pooc Oriental'],
            ['code' => '05024725', 'city_code' => '050247', 'name' => 'Potohan'],
            ['code' => '05024726', 'city_code' => '050247', 'name' => 'Talenceras'],
            ['code' => '05024727', 'city_code' => '050247', 'name' => 'Tan-awan'],
            ['code' => '05024728', 'city_code' => '050247', 'name' => 'Tinangnan'],
            ['code' => '05024729', 'city_code' => '050247', 'name' => 'Ubay Island'],
            ['code' => '05024730', 'city_code' => '050247', 'name' => 'Ubojan'],
            ['code' => '05024731', 'city_code' => '050247', 'name' => 'Villanueva'],
            ['code' => '05024732', 'city_code' => '050247', 'name' => 'Villaflor'],
            ['code' => '05024733', 'city_code' => '050247', 'name' => 'San Isidro'],
            ['code' => '05024734', 'city_code' => '050247', 'name' => 'San Vicente'],

            // Ubay (050248) - 3 sample barangays
            ['code' => '05024801', 'city_code' => '050248', 'name' => 'Poblacion'],
            ['code' => '05024802', 'city_code' => '050248', 'name' => 'Achila'],
            ['code' => '05024803', 'city_code' => '050248', 'name' => 'Bay-ang'],

            // Valencia (050249) - 3 sample barangays
            ['code' => '05024901', 'city_code' => '050249', 'name' => 'Poblacion'],
            ['code' => '05024902', 'city_code' => '050249', 'name' => 'Adlawan'],
            ['code' => '05024903', 'city_code' => '050249', 'name' => 'Anas'],

            // Other cities (sample barangays)
            // Cebu City (050101)
            ['code' => '05010101', 'city_code' => '050101', 'name' => 'Adlaon'],
            ['code' => '05010102', 'city_code' => '050101', 'name' => 'Agsungot'],
            ['code' => '05010103', 'city_code' => '050101', 'name' => 'Apas'],

            // Manila (010101)
            ['code' => '01010101', 'city_code' => '010101', 'name' => 'Binondo'],
            ['code' => '01010102', 'city_code' => '010101', 'name' => 'Ermita'],
            ['code' => '01010103', 'city_code' => '010101', 'name' => 'Intramuros'],
        ];

        foreach ($barangays as $barangay) {
            if (!City::where('code', $barangay['city_code'])->exists()) {
                $this->command->error("Missing city: {$barangay['city_code']}");
                continue;
            }

            Barangay::firstOrCreate(
                ['code' => $barangay['code']],
                [
                    'city_code' => $barangay['city_code'],
                    'name' => $barangay['name']
                ]
            );
        }
    }
}
