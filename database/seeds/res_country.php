<?php

use Illuminate\Database\Seeder;

class res_country extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('res_country')->insert(
            ['Andorra', 'AD', '%(street)s%(street2)%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 376, 'before', null],
            ['United Arab Emirates', 'AE', '%(street)s%(street2)%(city)s %(state_code)s %(zip)s%(country_name)s', null, 131, 971, 'before', null],
            ['Afghanistan', 'AF', '%(street)s%(street2)%(city)s %(state_code)s %(zip)s%(country_name)s', null, 47, 93, 'before', null],
            ['Antigua and Barbuda', 'AG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 1268, 'before', null],
            ['Anguilla', 'AI', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 1264, 'before', null],
            ['Albania', 'AL', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 122, 355, 'before', null],
            ['Armenia', 'AM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 50, 374, 'before', null],
            ['Angola', 'AO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 48, 244, 'before', null],
            ['Antarctica', 'AQ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 672, 'before', null],
            ['Argentina', 'AR', '%(street)s%(street2)s%(city)s %(state_name)s %(zip)s%(country_name)s', null, 19, 54, 'before', 'CUIT'],
            ['American Samoa', 'AS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 1684, 'before', null],
            ['Austria', 'AT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 43, 'before', 'VAT'],
            ['Australia', 'AU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 21, 61, 'before', null],
            ['Aruba', 'AW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 51, 297, 'before', null],
            ['Åland Islands', 'AX', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 358, 'before', null],
            ['Azerbaijan', 'AZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 52, 994, 'before', null],
            ['Bosnia and Herzegovina', 'BA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 63, 387, 'before', null],
            ['Barbados', 'BB', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 56, 1246, 'before', null],
            ['Bangladesh', 'BD', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 55, 880, 'before', null],
            ['Belgium', 'BE', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 1, 32, 'before', 'VAT'],
            ['Burkina Faso', 'BF', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 41, 226, 'before', null],
            ['Bulgaria', 'BG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 26, 359, 'before', 'VAT'],
            ['Bahrain', 'BH', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 54, 973, 'before', null],
            ['Burundi', 'BI', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 65, 257, 'before', null],
            ['Benin', 'BJ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 41, 229, 'before', null],
            ['Saint Barthélémy', 'BL', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 590, 'before', null],
            ['Bermuda', 'BM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 60, 1441, 'before', null],
            ['Brunei Darussalam', 'BN', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 113, 673, 'before', null],
            ['Bolivia', 'BO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 62, 591, 'before', null],
            ['Bonaire, Sint Eustatius and Saba', 'BQ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 599, 'before', null],
            ['Brazil', 'BR', '%(street)s%(street2)s%(city)s %(state_code)s%(zip)s%(country_name)s', null, 6, 55, 'before', null],
            ['Bahamas', 'BS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 53, 1242, 'before', null],
            ['Bhutan', 'BT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 61, 975, 'before', null],
            ['Bouvet Island', 'BV', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 14, 55, 'before', null],
            ['Botswana', 'BW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 64, 267, 'before', null],
            ['Belarus', 'BY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 58, 375, 'before', null],
            ['Belize', 'BZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 59, 501, 'before', null],
            ['Canada', 'CA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 4, 1, 'before', 'HST'],
            ['Cocos (Keeling) Islands', 'CC', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 21, 61, 'before', null],
            ['Central African Republic', 'CF', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 42, 236, 'before', null],
            ['Democratic Republic of the Congo', 'CD', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 69, 242, 'before', null],
            ['Congo', 'CG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 42, 243, 'before', null],
            ['Switzerland', 'CH', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 5, 41, 'before', null],
            ['Côte dIvoire', 'CI', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 41, 225, 'before', null],
            ['Cook Islands', 'CK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 35, 682, 'before', null],
            ['Chile', 'CL', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 45, 56, 'before', null],
            ['Cameroon', 'CM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 42, 237, 'before', null],
            ['China', 'CN', '%(country_name)s%(state_name)s%(city)s%(street)%(street2)s %(zip)s', null, 7, 86, 'before', null],
            ['Colombia', 'CO', '%(street)s%(street2)s%(city)s %(state_name)s %(zip)s%(country_name)s', null, 8, 57, 'before', 'NIT'],
            ['Costa Rica', 'CR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 39, 506, 'before', null],
            ['Cuba', 'CU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 70, 53, 'before', null],
            ['Cape Verde', 'CV', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 167, 238, 'before', null],
            ['Curaçao', 'CW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 71, 599, 'before', null],
            ['Christmas Island', 'CX', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 21, 61, 'before', null],
            ['Cyprus', 'CY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 72, 357, 'before', 'VAT'],
            ['Czech Republic', 'CZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 9, 420, 'before', 'VAT'],
            ['Germany', 'DE', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 1, 49, 'before', 'VAT'],
            ['Djibouti', 'DJ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 73, 253, 'before', null],
            ['Denmark', 'DK', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 10, 45, 'before', 'VAT'],
            ['Dominica', 'DM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 1767, 'before', null],
            ['Dominican Republic', 'DO', '%(street)s%(street2)s%(city)s %(state_name)s %(zip)s%(country_name)s', null, 74, 1849, 'before', 'RNC'],
            ['Algeria', 'DZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 114, 213, 'before', null],
            ['Ecuador', 'EC', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 593, 'before', null],
            ['Estonia', 'EE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 372, 'before', 'VAT'],
            ['Egypt', 'EG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 76, 20, 'before', null],
            ['Western Sahara', 'EH', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 112, 212, 'before', null],
            ['Eritrea', 'ER', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 78, 291, 'before', null],
            ['Spain', 'ES', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 1, 34, 'before', 'VAT'],
            ['Ethiopia', 'ET', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 79, 251, 'before', null],
            ['Finland', 'FI', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 1, 358, 'before', 'VAT'],
            ['Fiji', 'FJ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 81, 679, 'before', null],
            ['Falkland Islands', 'FK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 80, 500, 'before', null],
            ['Micronesia', 'FM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 691, 'before', null],
            ['Faroe Islands', 'FO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 10, 298, 'before', null],
            ['France', 'FR', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 1, 33, 'before', 'VAT'],
            ['Gabon', 'GA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 42, 241, 'before', null],
            ['Grenada', 'GD', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 1473, 'before', null],
            ['Georgia', 'GE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 82, 995, 'before', null],
            ['French Guiana', 'GF', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 594, 'before', null],
            ['Ghana', 'GH', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 115, 233, 'before', null],
            ['Gibraltar', 'GI', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 83, 350, 'before', null],
            ['Guernsey', 'GG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 147, 44, 'before', null],
            ['Greenland', 'GL', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 10, 299, 'before', null],
            ['Gambia', 'GM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 116, 220, 'before', null],
            ['Guinea', 'GN', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 85, 224, 'before', null],
            ['Guadeloupe', 'GP', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 590, 'before', null],
            ['Equatorial Guinea', 'GQ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 42, 240, 'before', null],
            ['Greece', 'GR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 30, 'before', 'VAT'],
            ['South Georgia and the South Sandwich Islands', 'GS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 147, 500, 'before', null],
            ['Guatemala', 'GT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 170, 502, 'before', 'NIT'],
            ['Guam', 'GU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 1671, 'before', null],
            ['Guinea-Bissau', 'GW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 41, 245, 'before', null],
            ['Guyana', 'GY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 86, 592, 'before', null],
            ['Hong Kong', 'HK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 24, 852, 'before', null],
            ['Heard Island and McDonald Islands', 'HM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 21, 672, 'before', null],
            ['Honduras', 'HN', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 44, 504, 'before', null],
            ['Croatia', 'HR', '%(street)s %(street2)s %(zip)s%(city)s %(country_name)s', null, 29, 385, 'before', 'VAT'],
            ['Haiti', 'HT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 87, 509, 'before', null],
            ['Hungary', 'HU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 11, 36, 'before', 'VAT'],
            ['Indonesia', 'ID', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 12, 62, 'before', null],
            ['Ireland', 'IE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 353, 'before', 'VAT'],
            ['Israel', 'IL', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 91, 972, 'before', null],
            ['Isle of Man', 'IM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 147, 44, 'before', null],
            ['India', 'IN', '%(street)s%(street2)s%(city)s %(zip)s%(state_name)s %(state_code)s%(country_name)s', null, 20, 91, 'before', 'GSTIN'],
            ['British Indian Ocean Territory', 'IO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 246, 'before', null],
            ['Iraq', 'IQ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 90, 964, 'before', null],
            ['Iran', 'IR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 89, 98, 'before', null],
            ['Iceland', 'IS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 88, 354, 'before', null],
            ['Italy', 'IT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 39, 'before', 'VAT'],
            ['Jersey', 'JE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 147, 44, 'before', null],
            ['Jamaica', 'JM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 92, 1876, 'before', null],
            ['Jordan', 'JO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 93, 962, 'before', null],
            ['Japan', 'JP', '%(zip)s%(state_name)s %(city)s%(street)s%(street2)s%(country_name)s', null, 25, 81, 'after', null],
            ['Kenya', 'KE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 95, 254, 'before', null],
            ['Kyrgyzstan', 'KG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 97, 996, 'before', null],
            ['Cambodia', 'KH', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 66, 855, 'before', null],
            ['Kiribati', 'KI', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 21, 686, 'before', null],
            ['Comoros', 'KM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 68, 269, 'before', null],
            ['Saint Kitts and Nevis', 'KN', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 1869, 'before', null],
            ['North Korea', 'KP', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 125, 850, 'before', null],
            ['South Korea', 'KR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 32, 82, 'before', null],
            ['Kuwait', 'KW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 96, 965, 'before', null],
            ['Cayman Islands', 'KY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 67, 1345, 'before', null],
            ['Kazakhstan', 'KZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 94, 7, 'before', null],
            ['Laos', 'LA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 98, 856, 'before', null],
            [ 'Lebanon', 'LB', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 99, 961, 'before', null],
            ['Saint Lucia', 'LC', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 1758, 'before', null],
            ['Liechtenstein', 'LI', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 5, 423, 'before', null],
            ['Sri Lanka', 'LK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 145, 94, 'before', null],
            ['Liberia', 'LR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 101, 231, 'before', null],
            ['Lesotho', 'LS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 100, 266, 'before', null],
            ['Lithuania', 'LT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 370, 'before', 'VAT'],
            [ 'Luxembourg', 'LU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 352, 'before', 'VAT'],
            ['Latvia', 'LV', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 371, 'before', 'VAT'],
            ['Libya', 'LY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 102, 218, 'before', null],
            ['Morocco', 'MA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 112, 212, 'before', null],
            [ 'Monaco', 'MC', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 377, 'before', null],
            ['Moldova', 'MD', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 110, 373, 'before', null],
            ['Montenegro', 'ME', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 102, 382, 'before', null],
            ['Saint Martin (French part)', 'MF', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 590, 'before', null],
            ['Madagascar', 'MG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 105, 261, 'before', null],
            [ 'Marshall Islands', 'MH', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 692, 'before', null],
            ['Macedonia, the former Yugoslav Republic of', 'MK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 104, 389, 'before', null],
            ['Mali', 'ML', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 41, 223, 'before', null],
            ['Myanmar', 'MM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 119, 95, 'before', null],
            ['Mongolia', 'MN', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 111, 976, 'before', null],
            ['Macau', 'MO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 103, 853, 'before', null],
            ['Northern Mariana Islands', 'MP', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 1670, 'before', null],
            ['Martinique', 'MQ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 596, 'before', null],
            ['Mauritania', 'MR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 109, 222, 'before', null],
            ['Montserrat', 'MS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 1664, 'before', null],
            ['Malta', 'MT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 356, 'before', 'VAT'],
            ['Mauritius', 'MU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 40, 230, 'before', null],
            ['Maldives', 'MV', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 107, 960, 'before', null],
            ['Malawi', 'MW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 106, 265, 'before', null],
            ['Mexico', 'MX', '%(street)s%(street2)s%(zip)s %(city)s, %(state_code)s%(country_name)s', null, 33, 52, 'before', 'RFC'],
            ['Malaysia', 'MY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 34, 60, 'before', null],
            ['Mozambique', 'MZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 118, 258, 'before', null],
            ['Namibia', 'NA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 120, 264, 'before', null],
            ['New Caledonia', 'NC', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 15, 687, 'before', null],
            [ 'Niger', 'NE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 41, 227, 'before', null],
            ['Norfolk Island', 'NF', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 21, 672, 'before', null],
            ['Nigeria', 'NG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 124, 234, 'before', null],
            ['Nicaragua', 'NI', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 123, 505, 'before', null],
            ['Netherlands', 'NL', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 1, 31, 'before', 'VAT'],
            ['Norway', 'NO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 14, 47, 'before', null],
            ['Nepal', 'NP', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 121, 977, 'before', null],
            ['Nauru', 'NR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 21, 674, 'before', null],
            ['Niue', 'NU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 35, 683, 'before', null],
            ['New Zealand', 'NZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 35, 64, 'before', null],
            [ 'Oman', 'OM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 166, 968, 'before', null],
            ['Panama', 'PA', '%(street)s%(street2)s%(city)s %(state_name)s %(zip)s%(country_name)s', null, 16, 507, 'before', null],
            ['Peru', 'PE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 162, 51, 'before', null],
            ['French Polynesia', 'PF', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 15, 689, 'before', null],
            ['Papua New Guinea', 'PG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 164, 675, 'before', null],
            ['Philippines', 'PH', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 36, 63, 'before', null],
            ['Pakistan', 'PK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 165, 92, 'before', null],
            ['Poland', 'PL', '%(street)s%(street2)s%(zip)s %(city)s%(country_name)s', null, 17, 48, 'before', 'VAT'],
            ['Saint Pierre and Miquelon', 'PM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 508, 'before', null],
            ['Pitcairn Islands', 'PN', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 35, 64, 'before', null],
            ['Puerto Rico', 'PR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 1939, 'before', null],
            ['State of Palestine', 'PS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 91, 970, 'before', null],
            ['Portugal', 'PT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 351, 'before', 'VAT'],
            ['Palau', 'PW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 680, 'before', null],
            ['Paraguay', 'PY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 163, 595, 'before', null],
            ['Qatar', 'QA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 160, 974, 'before', null],
            ['Réunion', 'RE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 262, 'before', null],
            ['Romania', 'RO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 28, 40, 'before', 'VAT'],
            ['Serbia', 'RS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 152, 381, 'before', null],
            ['Russian Federation', 'RU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 30, 7, 'before', null],
            ['Rwanda', 'RW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 158, 250, 'before', null],
            ['Saudi Arabia', 'SA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 153, 966, 'before', null],
            ['Solomon Islands', 'SB', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 149, 677, 'before', null],
            ['Seychelles', 'SC', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 151, 248, 'before', null],
            ['Sudan', 'SD', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 144, 249, 'before', null],
            ['Sweden', 'SE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 18, 46, 'before', 'VAT'],
            ['Singapore', 'SG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 37, 65, 'before', 'GST No.'],
            [ 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 157, 290, 'before', null],
            ['Slovenia', 'SI', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 386, 'before', 'VAT'],
            ['Svalbard and Jan Mayen', 'SJ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 14, 47, 'before', null],
            [ 'Slovakia', 'SK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 168, 421, 'before', 'VAT'],
            ['Sierra Leone', 'SL', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 150, 232, 'before', null],
            [ 'San Marino', 'SM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 155, 378, 'before', null],
            [ 'Senegal', 'SN', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 41, 221, 'before', null],
            ['Somalia', 'SO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 148, 252, 'before', null],
            ['Suriname', 'SR', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 143, 597, 'before', null],
            ['South Sudan', 'SS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 146, 211, 'before', null],
            ['São Tomé and Príncipe', 'ST', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 154, 239, 'before', null],
            ['El Salvador', 'SV', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 77, 503, 'before', null],
            ['Sint Maarten (Dutch part)', 'SX', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 71, 1721, 'before', null],
            ['Syria', 'SY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 141, 963, 'before', null],
            ['Swaziland', 'SZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 142, 268, 'before', null],
            ['Turks and Caicos Islands', 'TC', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 1649, 'before', null],
            ['Chad', 'TD', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 42, 235, 'before', null],
            ['French Southern Territories', 'TF', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 262, 'before', null],
            ['Togo', 'TG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 41, 228, 'before', null],
            ['Thailand', 'TH', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 137, 66, 'before', null],
            ['Tajikistan', 'TJ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 139, 992, 'before', null],
            ['Tokelau', 'TK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 35, 690, 'before', null],
            ['Turkmenistan', 'TM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 133, 993, 'before', null],
            ['Tunisia', 'TN', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 134, 216, 'before', null],
            ['Tonga', 'TO', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 136, 676, 'before', null],
            ['Timor-Leste', 'TL', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 670, 'before', null],
            ['Turkey', 'TR', '%(street)s%(street2)s%(city)s %(state_name)s %(zip)s%(country_name)s', null, 31, 90, 'before', null],
            ['Trinidad and Tobago', 'TT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 135, 1868, 'before', null],
            ['Tuvalu', 'TV', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 21, 688, 'before', null],
            ['Taiwan', 'TW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 140, 886, 'before', null],
            ['Tanzania', 'TZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 138, 255, 'before', null],
            ['Ukraine', 'UA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 22, 380, 'before', null],
            ['Uganda', 'UG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 43, 256, 'before', null],
            ['United Kingdom', 'GB', '%(street)s%(street2)s%(city)s%(state_name)s%(zip)s%(country_name)s', null, 147, 44, 'before', 'VAT'],
            ['USA Minor Outlying Islands', 'UM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 699, 'before', null],
            ['United States', 'US', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 1, 'before', null],
            [ 'Uruguay', 'UY', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 46, 598, 'before', null],
            ['Uzbekistan', 'UZ', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 130, 998, 'before', null],
            ['Holy See (Vatican City State)', 'VA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 379, 'before', null],
            ['Saint Vincent and the Grenadines', 'VC', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 49, 1784, 'before', null],
            ['Venezuela', 'VE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 3, 58, 'before', null],
            ['Virgin Islands (British)', 'VG', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 1284, 'before', null],
            ['Virgin Islands (USA)', 'VI', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 2, 1340, 'before', null],
            [ 'Vietnam', 'VN', '%(street)s%(street2)s%(city)s%(state_name)s %(country_name)s', null, 23, 84, 'before', null],
            ['Vanuatu', 'VU', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 129, 678, 'before', null],
            ['Wallis and Futuna', 'WF', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 15, 681, 'before', null],
            ['Samoa', 'WS', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 156, 685, 'before', null],
            ['Yemen', 'YE', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 128, 967, 'before', null],
            ['Mayotte', 'YT', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 262, 'before', null],
            ['South Africa', 'ZA', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 38, 27, 'before', null],
            ['Zambia', 'ZM', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 127, 260, 'before', null],
            ['Zimbabwe', 'ZW', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 126, 263, 'before', null],
            ['Kosovo', 'XK', '%(street)s%(street2)s%(city)s %(state_code)s %(zip)s%(country_name)s', null, 1, 383, 'before', null],
        );
    }
}