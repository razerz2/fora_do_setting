<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["id_pais" => "1", "nome" => "Afeganistão", "sigla2" => "AF", "sigla3" => "AFG", "codigo" => "004"],
            ["id_pais" => "2", "nome" => "África do Sul", "sigla2" => "ZA", "sigla3" => "ZAF", "codigo" => "710"],
            ["id_pais" => "3", "nome" => "Albânia", "sigla2" => "AL", "sigla3" => "ALB", "codigo" => "008"],
            ["id_pais" => "4", "nome" => "Alemanha", "sigla2" => "DE", "sigla3" => "DEU", "codigo" => "276"],
            ["id_pais" => "5", "nome" => "Andorra", "sigla2" => "AD", "sigla3" => "AND", "codigo" => "020"],
            ["id_pais" => "6", "nome" => "Angola", "sigla2" => "AO", "sigla3" => "AGO", "codigo" => "024"],
            ["id_pais" => "7", "nome" => "Anguilla", "sigla2" => "AI", "sigla3" => "AIA", "codigo" => "660"],
            ["id_pais" => "8", "nome" => "Antártida", "sigla2" => "AQ", "sigla3" => "ATA", "codigo" => "010"],
            ["id_pais" => "9", "nome" => "Antígua e Barbuda", "sigla2" => "AG", "sigla3" => "ATG", "codigo" => "028"],
            ["id_pais" => "10", "nome" => "Antilhas Holandesas", "sigla2" => "AN", "sigla3" => "ANT", "codigo" => "530"],
            ["id_pais" => "11", "nome" => "Arábia Saudita", "sigla2" => "SA", "sigla3" => "SAU", "codigo" => "682"],
            ["id_pais" => "12", "nome" => "Argélia", "sigla2" => "DZ", "sigla3" => "DZA", "codigo" => "012"],
            ["id_pais" => "13", "nome" => "Argentina", "sigla2" => "AR", "sigla3" => "ARG", "codigo" => "032"],
            ["id_pais" => "14", "nome" => "Armênia", "sigla2" => "AM", "sigla3" => "ARM", "codigo" => "51"],
            ["id_pais" => "15", "nome" => "Aruba", "sigla2" => "AW", "sigla3" => "ABW", "codigo" => "533"],
            ["id_pais" => "16", "nome" => "Austrália", "sigla2" => "AU", "sigla3" => "AUS", "codigo" => "036"],
            ["id_pais" => "17", "nome" => "Áustria", "sigla2" => "AT", "sigla3" => "AUT", "codigo" => "040"],
            ["id_pais" => "18", "nome" => "Azerbaijão", "sigla2" => "AZ ", "sigla3" => "AZE", "codigo" => "31"],
            ["id_pais" => "19", "nome" => "Bahamas", "sigla2" => "BS", "sigla3" => "BHS", "codigo" => "044"],
            ["id_pais" => "20", "nome" => "Bahrein", "sigla2" => "BH", "sigla3" => "BHR", "codigo" => "048"],
            ["id_pais" => "21", "nome" => "Bangladesh", "sigla2" => "BD", "sigla3" => "BGD", "codigo" => "050"],
            ["id_pais" => "22", "nome" => "Barbados", "sigla2" => "BB", "sigla3" => "BRB", "codigo" => "052"],
            ["id_pais" => "23", "nome" => "Belarus", "sigla2" => "BY", "sigla3" => "BLR", "codigo" => "112"],
            ["id_pais" => "24", "nome" => "Bélgica", "sigla2" => "BE", "sigla3" => "BEL", "codigo" => "056"],
            ["id_pais" => "25", "nome" => "Belize", "sigla2" => "BZ", "sigla3" => "BLZ", "codigo" => "084"],
            ["id_pais" => "26", "nome" => "Benin", "sigla2" => "BJ", "sigla3" => "BEN", "codigo" => "204"],
            ["id_pais" => "27", "nome" => "Bermudas", "sigla2" => "BM", "sigla3" => "BMU", "codigo" => "060"],
            ["id_pais" => "28", "nome" => "Bolívia", "sigla2" => "BO", "sigla3" => "BOL", "codigo" => "068"],
            ["id_pais" => "29", "nome" => "Bósnia-Herzegóvina", "sigla2" => "BA", "sigla3" => "BIH", "codigo" => "070"],
            ["id_pais" => "30", "nome" => "Botsuana", "sigla2" => "BW", "sigla3" => "BWA", "codigo" => "072"],
            ["id_pais" => "31", "nome" => "Brasil", "sigla2" => "BR", "sigla3" => "BRA", "codigo" => "055"],
            ["id_pais" => "32", "nome" => "Brunei", "sigla2" => "BN", "sigla3" => "BRN", "codigo" => "096"],
            ["id_pais" => "33", "nome" => "Bulgária", "sigla2" => "BG", "sigla3" => "BGR", "codigo" => "100"],
            ["id_pais" => "34", "nome" => "Burkina Fasso", "sigla2" => "BF", "sigla3" => "BFA", "codigo" => "854"],
            ["id_pais" => "35", "nome" => "Burundi", "sigla2" => "BI", "sigla3" => "BDI", "codigo" => "108"],
            ["id_pais" => "36", "nome" => "Butão", "sigla2" => "BT", "sigla3" => "BTN", "codigo" => "064"],
            ["id_pais" => "37", "nome" => "Cabo Verde", "sigla2" => "CV", "sigla3" => "CPV", "codigo" => "132"],
            ["id_pais" => "38", "nome" => "Camarões", "sigla2" => "CM", "sigla3" => "CMR", "codigo" => "120"],
            ["id_pais" => "39", "nome" => "Camboja", "sigla2" => "KH", "sigla3" => "KHM", "codigo" => "116"],
            ["id_pais" => "40", "nome" => "Canadá", "sigla2" => "CA", "sigla3" => "CAN", "codigo" => "124"],
            ["id_pais" => "41", "nome" => "Cazaquistão", "sigla2" => "KZ", "sigla3" => "KAZ", "codigo" => "398"],
            ["id_pais" => "42", "nome" => "Chade", "sigla2" => "TD", "sigla3" => "TCD", "codigo" => "148"],
            ["id_pais" => "43", "nome" => "Chile", "sigla2" => "CL", "sigla3" => "CHL", "codigo" => "152"],
            ["id_pais" => "44", "nome" => "China", "sigla2" => "CN", "sigla3" => "CHN", "codigo" => "156"],
            ["id_pais" => "45", "nome" => "Chipre", "sigla2" => "CY", "sigla3" => "CYP", "codigo" => "196"],
            ["id_pais" => "46", "nome" => "Cingapura", "sigla2" => "SG", "sigla3" => "SGP", "codigo" => "702"],
            ["id_pais" => "47", "nome" => "Colômbia", "sigla2" => "CO", "sigla3" => "COL", "codigo" => "170"],
            ["id_pais" => "48", "nome" => "Congo", "sigla2" => "CG", "sigla3" => "COG", "codigo" => "178"],
            ["id_pais" => "49", "nome" => "Coréia do Norte", "sigla2" => "KP", "sigla3" => "PRK", "codigo" => "408"],
            ["id_pais" => "50", "nome" => "Coréia do Sul", "sigla2" => "KR", "sigla3" => "KOR", "codigo" => "410"],
            ["id_pais" => "51", "nome" => "Costa do Marfim", "sigla2" => "CI", "sigla3" => "CIV", "codigo" => "384"],
            ["id_pais" => "52", "nome" => "Costa Rica", "sigla2" => "CR", "sigla3" => "CRI", "codigo" => "188"],
            ["id_pais" => "53", "nome" => "Croácia (Hrvatska)", "sigla2" => "HR", "sigla3" => "HRV", "codigo" => "191"],
            ["id_pais" => "54", "nome" => "Cuba", "sigla2" => "CU", "sigla3" => "CUB", "codigo" => "192"],
            ["id_pais" => "55", "nome" => "Dinamarca", "sigla2" => "DK", "sigla3" => "DNK", "codigo" => "208"],
            ["id_pais" => "56", "nome" => "Djibuti", "sigla2" => "DJ", "sigla3" => "DJI", "codigo" => "262"],
            ["id_pais" => "57", "nome" => "Dominica", "sigla2" => "DM", "sigla3" => "DMA", "codigo" => "212"],
            ["id_pais" => "58", "nome" => "Egito", "sigla2" => "EG", "sigla3" => "EGY", "codigo" => "818"],
            ["id_pais" => "59", "nome" => "El Salvador", "sigla2" => "SV", "sigla3" => "SLV", "codigo" => "222"],
            ["id_pais" => "60", "nome" => "Emirados Árabes Unidos", "sigla2" => "AE", "sigla3" => "ARE", "codigo" => "784"],
            ["id_pais" => "61", "nome" => "Equador", "sigla2" => "EC", "sigla3" => "ECU", "codigo" => "218"],
            ["id_pais" => "62", "nome" => "Eritréia", "sigla2" => "ER", "sigla3" => "ERI", "codigo" => "232"],
            ["id_pais" => "63", "nome" => "Eslováquia", "sigla2" => "SK", "sigla3" => "SVK", "codigo" => "703"],
            ["id_pais" => "64", "nome" => "Eslovênia", "sigla2" => "SI", "sigla3" => "SVN", "codigo" => "705"],
            ["id_pais" => "65", "nome" => "Espanha", "sigla2" => "ES", "sigla3" => "ESP", "codigo" => "724"],
            ["id_pais" => "66", "nome" => "Estados Unidos", "sigla2" => "US", "sigla3" => "USA", "codigo" => "840"],
            ["id_pais" => "67", "nome" => "Estônia", "sigla2" => "EE", "sigla3" => "EST", "codigo" => "233"],
            ["id_pais" => "68", "nome" => "Etiópia", "sigla2" => "ET", "sigla3" => "ETH", "codigo" => "231"],
            ["id_pais" => "69", "nome" => "Fiji", "sigla2" => "FJ", "sigla3" => "FJI", "codigo" => "242"],
            ["id_pais" => "70", "nome" => "Filipinas", "sigla2" => "PH", "sigla3" => "PHL", "codigo" => "608"],
            ["id_pais" => "71", "nome" => "Finlândia", "sigla2" => "FI", "sigla3" => "FIN", "codigo" => "246"],
            ["id_pais" => "72", "nome" => "França", "sigla2" => "FR", "sigla3" => "FRA", "codigo" => "250"],
            ["id_pais" => "73", "nome" => "Gabão", "sigla2" => "GA", "sigla3" => "GAB", "codigo" => "266"],
            ["id_pais" => "74", "nome" => "Gâmbia", "sigla2" => "GM", "sigla3" => "GMB", "codigo" => "270"],
            ["id_pais" => "75", "nome" => "Gana", "sigla2" => "GH", "sigla3" => "GHA", "codigo" => "288"],
            ["id_pais" => "76", "nome" => "Geórgia", "sigla2" => "GE", "sigla3" => "GEO", "codigo" => "268"],
            ["id_pais" => "77", "nome" => "Gibraltar", "sigla2" => "GI", "sigla3" => "GIB", "codigo" => "292"],
            ["id_pais" => "78", "nome" => "Grã-Bretanha (Reino Unido, UK)", "sigla2" => "GB", "sigla3" => "GBR", "codigo" => "826"],
            ["id_pais" => "79", "nome" => "Granada", "sigla2" => "GD", "sigla3" => "GRD", "codigo" => "308"],
            ["id_pais" => "80", "nome" => "Grécia", "sigla2" => "GR", "sigla3" => "GRC", "codigo" => "300"],
            ["id_pais" => "81", "nome" => "Groelândia", "sigla2" => "GL", "sigla3" => "GRL", "codigo" => "304"],
            ["id_pais" => "82", "nome" => "Guadalupe", "sigla2" => "GP", "sigla3" => "GLP", "codigo" => "312"],
            ["id_pais" => "83", "nome" => "Guam (Território dos Estados Unidos)", "sigla2" => "GU", "sigla3" => "GUM", "codigo" => "316"],
            ["id_pais" => "84", "nome" => "Guatemala", "sigla2" => "GT", "sigla3" => "GTM", "codigo" => "320"],
            ["id_pais" => "85", "nome" => "Guernsey", "sigla2" => "G", "sigla3" => "GGY", "codigo" => "832"],
            ["id_pais" => "86", "nome" => "Guiana", "sigla2" => "GY", "sigla3" => "GUY", "codigo" => "328"],
            ["id_pais" => "87", "nome" => "Guiana Francesa", "sigla2" => "GF", "sigla3" => "GUF", "codigo" => "254"],
            ["id_pais" => "88", "nome" => "Guiné", "sigla2" => "GN", "sigla3" => "GIN", "codigo" => "324"],
            ["id_pais" => "89", "nome" => "Guiné Equatorial", "sigla2" => "GQ", "sigla3" => "GNQ", "codigo" => "226"],
            ["id_pais" => "90", "nome" => "Guiné-Bissau", "sigla2" => "GW", "sigla3" => "GNB", "codigo" => "624"],
            ["id_pais" => "91", "nome" => "Haiti", "sigla2" => "HT", "sigla3" => "HTI", "codigo" => "332"],
            ["id_pais" => "92", "nome" => "Holanda", "sigla2" => "NL", "sigla3" => "NLD", "codigo" => "528"],
            ["id_pais" => "93", "nome" => "Honduras", "sigla2" => "HN", "sigla3" => "HND", "codigo" => "340"],
            ["id_pais" => "94", "nome" => "Hong Kong", "sigla2" => "HK", "sigla3" => "HKG", "codigo" => "344"],
            ["id_pais" => "95", "nome" => "Hungria", "sigla2" => "HU", "sigla3" => "HUN", "codigo" => "348"],
            ["id_pais" => "96", "nome" => "Iêmen", "sigla2" => "YE", "sigla3" => "YEM", "codigo" => "887"],
            ["id_pais" => "97", "nome" => "Ilha Bouvet (Território da Noruega)", "sigla2" => "BV", "sigla3" => "BVT", "codigo" => "074"],
            ["id_pais" => "98", "nome" => "Ilha do Homem", "sigla2" => "IM", "sigla3" => "IMN", "codigo" => "833"],
            ["id_pais" => "99", "nome" => "Ilha Natal", "sigla2" => "CX", "sigla3" => "CXR", "codigo" => "162"],
            ["id_pais" => "100", "nome" => "Ilha Pitcairn", "sigla2" => "PN", "sigla3" => "PCN", "codigo" => "612"],
            ["id_pais" => "101", "nome" => "Ilha Reunião", "sigla2" => "RE", "sigla3" => "REU", "codigo" => "638"],
            ["id_pais" => "102", "nome" => "Ilhas Aland", "sigla2" => "AX", "sigla3" => "ALA", "codigo" => "248"],
            ["id_pais" => "103", "nome" => "Ilhas Cayman", "sigla2" => "KY", "sigla3" => "CYM", "codigo" => "136"],
            ["id_pais" => "104", "nome" => "Ilhas Cocos", "sigla2" => "CC", "sigla3" => "CCK", "codigo" => "166"],
            ["id_pais" => "105", "nome" => "Ilhas Comores", "sigla2" => "KM", "sigla3" => "COM", "codigo" => "174"],
            ["id_pais" => "106", "nome" => "Ilhas Cook", "sigla2" => "CK", "sigla3" => "COK", "codigo" => "184"],
            ["id_pais" => "107", "nome" => "Ilhas Faroes", "sigla2" => "FO", "sigla3" => "FRO", "codigo" => "234"],
            ["id_pais" => "108", "nome" => "Ilhas Falkland (Malvinas)", "sigla2" => "FK", "sigla3" => "FLK", "codigo" => "238"],
            ["id_pais" => "109", "nome" => "Ilhas Geórgia do Sul e Sandwich do Sul", "sigla2" => "GS", "sigla3" => "SGS", "codigo" => "239"],
            ["id_pais" => "110", "nome" => "Ilhas Heard e McDonald (Território da Austrália)", "sigla2" => "HM", "sigla3" => "HMD", "codigo" => "334"],
            ["id_pais" => "111", "nome" => "Ilhas Marianas do Norte", "sigla2" => "MP", "sigla3" => "MNP", "codigo" => "580"],
            ["id_pais" => "112", "nome" => "Ilhas Marshall", "sigla2" => "MH", "sigla3" => "MHL", "codigo" => "584"],
            ["id_pais" => "113", "nome" => "Ilhas Menores dos Estados Unidos", "sigla2" => "UM", "sigla3" => "UMI", "codigo" => "581"],
            ["id_pais" => "114", "nome" => "Ilhas Norfolk", "sigla2" => "NF", "sigla3" => "NFK", "codigo" => "574"],
            ["id_pais" => "115", "nome" => "Ilhas Seychelles", "sigla2" => "SC", "sigla3" => "SYC", "codigo" => "690"],
            ["id_pais" => "116", "nome" => "Ilhas Solomão", "sigla2" => "SB", "sigla3" => "SLB", "codigo" => "090"],
            ["id_pais" => "117", "nome" => "Ilhas Svalbard e Jan Mayen", "sigla2" => "SJ", "sigla3" => "SJM", "codigo" => "744"],
            ["id_pais" => "118", "nome" => "Ilhas Tokelau", "sigla2" => "TK", "sigla3" => "TKL", "codigo" => "772"],
            ["id_pais" => "119", "nome" => "Ilhas Turks e Caicos", "sigla2" => "TC", "sigla3" => "TCA", "codigo" => "796"],
            ["id_pais" => "120", "nome" => "Ilhas Virgens (Estados Unidos)", "sigla2" => "VI", "sigla3" => "VIR", "codigo" => "850"],
            ["id_pais" => "121", "nome" => "Ilhas Virgens (Inglaterra)", "sigla2" => "VG", "sigla3" => "VGB", "codigo" => "092"],
            ["id_pais" => "122", "nome" => "Ilhas Wallis e Futuna", "sigla2" => "WF", "sigla3" => "WLF", "codigo" => "876"],
            ["id_pais" => "123", "nome" => "índia", "sigla2" => "IN", "sigla3" => "IND", "codigo" => "356"],
            ["id_pais" => "124", "nome" => "Indonésia", "sigla2" => "ID", "sigla3" => "IDN", "codigo" => "360"],
            ["id_pais" => "125", "nome" => "Irã", "sigla2" => "IR", "sigla3" => "IRN", "codigo" => "364"],
            ["id_pais" => "126", "nome" => "Iraque", "sigla2" => "IQ", "sigla3" => "IRQ", "codigo" => "368"],
            ["id_pais" => "127", "nome" => "Irlanda", "sigla2" => "IE", "sigla3" => "IRL", "codigo" => "372"],
            ["id_pais" => "128", "nome" => "Islândia", "sigla2" => "IS", "sigla3" => "ISL", "codigo" => "352"],
            ["id_pais" => "129", "nome" => "Israel", "sigla2" => "IL", "sigla3" => "ISR", "codigo" => "376"],
            ["id_pais" => "130", "nome" => "Itália", "sigla2" => "IT", "sigla3" => "ITA", "codigo" => "380"],
            ["id_pais" => "131", "nome" => "Jamaica", "sigla2" => "JM", "sigla3" => "JAM", "codigo" => "388"],
            ["id_pais" => "132", "nome" => "Japão", "sigla2" => "JP", "sigla3" => "JPN", "codigo" => "392"],
            ["id_pais" => "133", "nome" => "Jersey", "sigla2" => "JE", "sigla3" => "JEY", "codigo" => "832"],
            ["id_pais" => "134", "nome" => "Jordânia", "sigla2" => "JO", "sigla3" => "JOR", "codigo" => "400"],
            ["id_pais" => "135", "nome" => "Kênia", "sigla2" => "KE", "sigla3" => "KEN", "codigo" => "404"],
            ["id_pais" => "136", "nome" => "Kiribati", "sigla2" => "KI", "sigla3" => "KIR", "codigo" => "296"],
            ["id_pais" => "137", "nome" => "Kuait", "sigla2" => "KW", "sigla3" => "KWT", "codigo" => "414"],
            ["id_pais" => "138", "nome" => "Laos", "sigla2" => "LA", "sigla3" => "LAO", "codigo" => "418"],
            ["id_pais" => "139", "nome" => "Látvia", "sigla2" => "LV", "sigla3" => "LVA", "codigo" => "428"],
            ["id_pais" => "140", "nome" => "Lesoto", "sigla2" => "LS", "sigla3" => "LSO", "codigo" => "426"],
            ["id_pais" => "141", "nome" => "Líbano", "sigla2" => "LB", "sigla3" => "LBN", "codigo" => "422"],
            ["id_pais" => "142", "nome" => "Libéria", "sigla2" => "LR", "sigla3" => "LBR", "codigo" => "430"],
            ["id_pais" => "143", "nome" => "Líbia", "sigla2" => "LY", "sigla3" => "LBY", "codigo" => "434"],
            ["id_pais" => "144", "nome" => "Liechtenstein", "sigla2" => "LI", "sigla3" => "LIE", "codigo" => "438"],
            ["id_pais" => "145", "nome" => "Lituânia", "sigla2" => "LT", "sigla3" => "LTU", "codigo" => "440"],
            ["id_pais" => "146", "nome" => "Luxemburgo", "sigla2" => "LU", "sigla3" => "LUX", "codigo" => "442"],
            ["id_pais" => "147", "nome" => "Macau", "sigla2" => "MO", "sigla3" => "MAC", "codigo" => "446"],
            ["id_pais" => "148", "nome" => "Macedônia (República Yugoslava)", "sigla2" => "MK", "sigla3" => "MKD", "codigo" => "807"],
            ["id_pais" => "149", "nome" => "Madagascar", "sigla2" => "MG", "sigla3" => "MDG", "codigo" => "450"],
            ["id_pais" => "150", "nome" => "Malásia", "sigla2" => "MY", "sigla3" => "MYS", "codigo" => "458"],
            ["id_pais" => "151", "nome" => "Malaui", "sigla2" => "MW", "sigla3" => "MWI", "codigo" => "454"],
            ["id_pais" => "152", "nome" => "Maldivas", "sigla2" => "MV", "sigla3" => "MDV", "codigo" => "462"],
            ["id_pais" => "153", "nome" => "Mali", "sigla2" => "ML", "sigla3" => "MLI", "codigo" => "466"],
            ["id_pais" => "154", "nome" => "Malta", "sigla2" => "MT", "sigla3" => "MLT", "codigo" => "470"],
            ["id_pais" => "155", "nome" => "Marrocos", "sigla2" => "MA", "sigla3" => "MAR", "codigo" => "504"],
            ["id_pais" => "156", "nome" => "Martinica", "sigla2" => "MQ", "sigla3" => "MTQ", "codigo" => "474"],
            ["id_pais" => "157", "nome" => "Maurício", "sigla2" => "MU", "sigla3" => "MUS", "codigo" => "480"],
            ["id_pais" => "158", "nome" => "Mauritânia", "sigla2" => "MR", "sigla3" => "MRT", "codigo" => "478"],
            ["id_pais" => "159", "nome" => "Mayotte", "sigla2" => "YT", "sigla3" => "MYT", "codigo" => "175"],
            ["id_pais" => "160", "nome" => "México", "sigla2" => "MX", "sigla3" => "MEX", "codigo" => "484"],
            ["id_pais" => "161", "nome" => "Micronésia", "sigla2" => "FM", "sigla3" => "FSM", "codigo" => "583"],
            ["id_pais" => "162", "nome" => "Moçambique", "sigla2" => "MZ", "sigla3" => "MOZ", "codigo" => "508"],
            ["id_pais" => "163", "nome" => "Moldova", "sigla2" => "MD", "sigla3" => "MDA", "codigo" => "498"],
            ["id_pais" => "164", "nome" => "Mônaco", "sigla2" => "MC", "sigla3" => "MCO", "codigo" => "492"],
            ["id_pais" => "165", "nome" => "Mongólia", "sigla2" => "MN", "sigla3" => "MNG", "codigo" => "496"],
            ["id_pais" => "166", "nome" => "Montenegro", "sigla2" => "ME", "sigla3" => "MNE", "codigo" => "499"],
            ["id_pais" => "167", "nome" => "Montserrat", "sigla2" => "MS", "sigla3" => "MSR", "codigo" => "500"],
            ["id_pais" => "168", "nome" => "Myanma", "sigla2" => "MM", "sigla3" => "MMR", "codigo" => "104"],
            ["id_pais" => "169", "nome" => "Namíbia", "sigla2" => "NA", "sigla3" => "NAM", "codigo" => "516"],
            ["id_pais" => "170", "nome" => "Nauru", "sigla2" => "NR", "sigla3" => "NRU", "codigo" => "520"],
            ["id_pais" => "171", "nome" => "Nepal", "sigla2" => "NP", "sigla3" => "NPL", "codigo" => "524"],
            ["id_pais" => "172", "nome" => "Nicarágua", "sigla2" => "NI", "sigla3" => "NIC", "codigo" => "558"],
            ["id_pais" => "173", "nome" => "Níger", "sigla2" => "NE", "sigla3" => "NER", "codigo" => "562"],
            ["id_pais" => "174", "nome" => "Nigéria", "sigla2" => "NG", "sigla3" => "NGA", "codigo" => "566"],
            ["id_pais" => "175", "nome" => "Niue", "sigla2" => "NU", "sigla3" => "NIU", "codigo" => "570"],
            ["id_pais" => "176", "nome" => "Noruega", "sigla2" => "NO", "sigla3" => "NOR", "codigo" => "578"],
            ["id_pais" => "177", "nome" => "Nova Caledônia", "sigla2" => "NC", "sigla3" => "NCL", "codigo" => "540"],
            ["id_pais" => "178", "nome" => "Nova Zelândia", "sigla2" => "NZ", "sigla3" => "NZL", "codigo" => "554"],
            ["id_pais" => "179", "nome" => "Omã", "sigla2" => "OM", "sigla3" => "OMN", "codigo" => "512"],
            ["id_pais" => "180", "nome" => "Palau", "sigla2" => "PW", "sigla3" => "PLW", "codigo" => "585"],
            ["id_pais" => "181", "nome" => "Panamá", "sigla2" => "PA", "sigla3" => "PAN", "codigo" => "591"],
            ["id_pais" => "182", "nome" => "Papua-Nova Guiné", "sigla2" => "PG", "sigla3" => "PNG", "codigo" => "598"],
            ["id_pais" => "183", "nome" => "Paquistão", "sigla2" => "PK", "sigla3" => "PAK", "codigo" => "586"],
            ["id_pais" => "184", "nome" => "Paraguai", "sigla2" => "PY", "sigla3" => "PRY", "codigo" => "600"],
            ["id_pais" => "185", "nome" => "Peru", "sigla2" => "PE", "sigla3" => "PER", "codigo" => "604"],
            ["id_pais" => "186", "nome" => "Polinésia Francesa", "sigla2" => "PF", "sigla3" => "PYF", "codigo" => "258"],
            ["id_pais" => "187", "nome" => "Polônia", "sigla2" => "PL", "sigla3" => "POL", "codigo" => "616"],
            ["id_pais" => "188", "nome" => "Porto Rico", "sigla2" => "PR", "sigla3" => "PRI", "codigo" => "630"],
            ["id_pais" => "189", "nome" => "Portugal", "sigla2" => "PT", "sigla3" => "PRT", "codigo" => "620"],
            ["id_pais" => "190", "nome" => "Qatar", "sigla2" => "QA", "sigla3" => "QAT", "codigo" => "634"],
            ["id_pais" => "191", "nome" => "Quirguistão", "sigla2" => "KG", "sigla3" => "KGZ", "codigo" => "417"],
            ["id_pais" => "192", "nome" => "República Centro-Africana", "sigla2" => "CF", "sigla3" => "CAF", "codigo" => "140"],
            ["id_pais" => "193", "nome" => "República Democrática do Congo", "sigla2" => "CD", "sigla3" => "COD", "codigo" => "180"],
            ["id_pais" => "194", "nome" => "República Dominicana", "sigla2" => "DO", "sigla3" => "DOM", "codigo" => "214"],
            ["id_pais" => "195", "nome" => "República Tcheca", "sigla2" => "CZ", "sigla3" => "CZE", "codigo" => "203"],
            ["id_pais" => "196", "nome" => "Romênia", "sigla2" => "RO", "sigla3" => "ROM", "codigo" => "642"],
            ["id_pais" => "197", "nome" => "Ruanda", "sigla2" => "RW", "sigla3" => "RWA", "codigo" => "646"],
            ["id_pais" => "198", "nome" => "Rússia (antiga URSS) - Federação Russa", "sigla2" => "RU", "sigla3" => "RUS", "codigo" => "643"],
            ["id_pais" => "199", "nome" => "Saara Ocidental", "sigla2" => "EH", "sigla3" => "ESH", "codigo" => "732"],
            ["id_pais" => "200", "nome" => "Saint Vincente e Granadinas", "sigla2" => "VC", "sigla3" => "VCT", "codigo" => "670"],
            ["id_pais" => "201", "nome" => "Samoa Americana", "sigla2" => "AS", "sigla3" => "ASM", "codigo" => "016"],
            ["id_pais" => "202", "nome" => "Samoa Ocidental", "sigla2" => "WS", "sigla3" => "WSM", "codigo" => "882"],
            ["id_pais" => "203", "nome" => "San Marino", "sigla2" => "SM", "sigla3" => "SMR", "codigo" => "674"],
            ["id_pais" => "204", "nome" => "Santa Helena", "sigla2" => "SH", "sigla3" => "SHN", "codigo" => "654"],
            ["id_pais" => "205", "nome" => "Santa Lúcia", "sigla2" => "LC", "sigla3" => "LCA", "codigo" => "662"],
            ["id_pais" => "206", "nome" => "São Bartolomeu", "sigla2" => "BL", "sigla3" => "BLM", "codigo" => "652"],
            ["id_pais" => "207", "nome" => "São Cristóvão e Névis", "sigla2" => "KN", "sigla3" => "KNA", "codigo" => "659"],
            ["id_pais" => "208", "nome" => "São Martim", "sigla2" => "MF", "sigla3" => "MAF", "codigo" => "663"],
            ["id_pais" => "209", "nome" => "São Tomé e Príncipe", "sigla2" => "ST", "sigla3" => "STP", "codigo" => "678"],
            ["id_pais" => "210", "nome" => "Senegal", "sigla2" => "SN", "sigla3" => "SEN", "codigo" => "686"],
            ["id_pais" => "211", "nome" => "Serra Leoa", "sigla2" => "SL", "sigla3" => "SLE", "codigo" => "694"],
            ["id_pais" => "212", "nome" => "Sérvia", "sigla2" => "RS", "sigla3" => "SRB", "codigo" => "688"],
            ["id_pais" => "213", "nome" => "Síria", "sigla2" => "SY", "sigla3" => "SYR", "codigo" => "760"],
            ["id_pais" => "214", "nome" => "Somália", "sigla2" => "SO", "sigla3" => "SOM", "codigo" => "706"],
            ["id_pais" => "215", "nome" => "Sri Lanka", "sigla2" => "LK", "sigla3" => "LKA", "codigo" => "144"],
            ["id_pais" => "216", "nome" => "St. Pierre and Miquelon", "sigla2" => "PM", "sigla3" => "SPM", "codigo" => "666"],
            ["id_pais" => "217", "nome" => "Suazilândia", "sigla2" => "SZ", "sigla3" => "SWZ", "codigo" => "748"],
            ["id_pais" => "218", "nome" => "Sudão", "sigla2" => "SD", "sigla3" => "SDN", "codigo" => "736"],
            ["id_pais" => "219", "nome" => "Suécia", "sigla2" => "SE", "sigla3" => "SWE", "codigo" => "752"],
            ["id_pais" => "220", "nome" => "Suíça", "sigla2" => "CH", "sigla3" => "CHE", "codigo" => "756"],
            ["id_pais" => "221", "nome" => "Suriname", "sigla2" => "SR", "sigla3" => "SUR", "codigo" => "740"],
            ["id_pais" => "222", "nome" => "Tadjiquistão", "sigla2" => "TJ", "sigla3" => "TJK", "codigo" => "762"],
            ["id_pais" => "223", "nome" => "Tailândia", "sigla2" => "TH", "sigla3" => "THA", "codigo" => "764"],
            ["id_pais" => "224", "nome" => "Taiwan", "sigla2" => "TW", "sigla3" => "TWN", "codigo" => "158"],
            ["id_pais" => "225", "nome" => "Tanzânia", "sigla2" => "TZ", "sigla3" => "TZA", "codigo" => "834"],
            ["id_pais" => "226", "nome" => "Território Britânico do Oceano índico", "sigla2" => "IO", "sigla3" => "IOT", "codigo" => "086"],
            ["id_pais" => "227", "nome" => "Territórios do Sul da França", "sigla2" => "TF", "sigla3" => "ATF", "codigo" => "260"],
            ["id_pais" => "228", "nome" => "Territórios Palestinos Ocupados", "sigla2" => "PS", "sigla3" => "PSE", "codigo" => "275"],
            ["id_pais" => "229", "nome" => "Timor Leste", "sigla2" => "TP", "sigla3" => "TMP", "codigo" => "626"],
            ["id_pais" => "230", "nome" => "Togo", "sigla2" => "TG", "sigla3" => "TGO", "codigo" => "768"],
            ["id_pais" => "231", "nome" => "Tonga", "sigla2" => "TO", "sigla3" => "TON", "codigo" => "776"],
            ["id_pais" => "232", "nome" => "Trinidad and Tobago", "sigla2" => "TT", "sigla3" => "TTO", "codigo" => "780"],
            ["id_pais" => "233", "nome" => "Tunísia", "sigla2" => "TN", "sigla3" => "TUN", "codigo" => "788"],
            ["id_pais" => "234", "nome" => "Turcomenistão", "sigla2" => "TM", "sigla3" => "TKM", "codigo" => "795"],
            ["id_pais" => "235", "nome" => "Turquia", "sigla2" => "TR", "sigla3" => "TUR", "codigo" => "792"],
            ["id_pais" => "236", "nome" => "Tuvalu", "sigla2" => "TV", "sigla3" => "TUV", "codigo" => "798"],
            ["id_pais" => "237", "nome" => "Ucrânia", "sigla2" => "UA", "sigla3" => "UKR", "codigo" => "804"],
            ["id_pais" => "238", "nome" => "Uganda", "sigla2" => "UG", "sigla3" => "UGA", "codigo" => "800"],
            ["id_pais" => "239", "nome" => "Uruguai", "sigla2" => "UY", "sigla3" => "URY", "codigo" => "858"],
            ["id_pais" => "240", "nome" => "Uzbequistão", "sigla2" => "UZ", "sigla3" => "UZB", "codigo" => "860"],
            ["id_pais" => "241", "nome" => "Vanuatu", "sigla2" => "VU", "sigla3" => "VUT", "codigo" => "548"],
            ["id_pais" => "242", "nome" => "Vaticano", "sigla2" => "VA", "sigla3" => "VAT", "codigo" => "336"],
            ["id_pais" => "243", "nome" => "Venezuela", "sigla2" => "VE", "sigla3" => "VEN", "codigo" => "862"],
            ["id_pais" => "244", "nome" => "Vietnã", "sigla2" => "VN", "sigla3" => "VNM", "codigo" => "704"],
            ["id_pais" => "245", "nome" => "Zâmbia", "sigla2" => "ZM", "sigla3" => "ZMB", "codigo" => "894"],
            ["id_pais" => "246", "nome" => "Zimbábue", "sigla2" => "ZW", "sigla3" => "ZWE", "codigo" => "716"],
        ];

        DB::table('paises')->insert($data);

        // Ajuste a sequência do PostgreSQL para que o próximo valor seja 247
        DB::statement("SELECT setval(pg_get_serial_sequence('paises', 'id_pais'), 247, false)");
    }
}
