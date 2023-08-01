<?php

namespace Rgbcode_authform\classes\helpers;

abstract class Location {

	const COUNTRIES = [
		'AF' => [
			'name' => 'Afghanistan',
			'code' => '+93',
			'iso'  => 'AF',
		],
		'AX' => [
			'name' => 'Aland Islands',
			'code' => '+358',
			'iso'  => 'AX',
		],
		'AL' => [
			'name' => 'Albania',
			'code' => '+355',
			'iso'  => 'AL',
		],
		'DZ' => [
			'name' => 'Algeria',
			'code' => '+213',
			'iso'  => 'DZ',
		],
		'AS' => [
			'name' => 'AmericanSamoa',
			'code' => '+1684',
			'iso'  => 'AS',
		],
		'AD' => [
			'name' => 'Andorra',
			'code' => '+376',
			'iso'  => 'AD',
		],
		'AO' => [
			'name' => 'Angola',
			'code' => '+244',
			'iso'  => 'AO',
		],
		'AI' => [
			'name' => 'Anguilla',
			'code' => '+1264',
			'iso'  => 'AI',
		],
		'AQ' => [
			'name' => 'Antarctica',
			'code' => '+672',
			'iso'  => 'AQ',
		],
		'AG' => [
			'name' => 'Antigua and Barbuda',
			'code' => '+1268',
			'iso'  => 'AG',
		],
		'AR' => [
			'name' => 'Argentina',
			'code' => '+54',
			'iso'  => 'AR',
		],
		'AM' => [
			'name' => 'Armenia',
			'code' => '+374',
			'iso'  => 'AM',
		],
		'AW' => [
			'name' => 'Aruba',
			'code' => '+297',
			'iso'  => 'AW',
		],
		'AU' => [
			'name' => 'Australia',
			'code' => '+61',
			'iso'  => 'AU',
		],
		'AT' => [
			'name' => 'Austria',
			'code' => '+43',
			'iso'  => 'AT',
		],
		'AZ' => [
			'name' => 'Azerbaijan',
			'code' => '+994',
			'iso'  => 'AZ',
		],
		'BS' => [
			'name' => 'Bahamas',
			'code' => '+1242',
			'iso'  => 'BS',
		],
		'BH' => [
			'name' => 'Bahrain',
			'code' => '+973',
			'iso'  => 'BH',
		],
		'BD' => [
			'name' => 'Bangladesh',
			'code' => '+880',
			'iso'  => 'BD',
		],
		'BB' => [
			'name' => 'Barbados',
			'code' => '+1246',
			'iso'  => 'BB',
		],
		'BY' => [
			'name' => 'Belarus',
			'code' => '+375',
			'iso'  => 'BY',
		],
		'BE' => [
			'name' => 'Belgium',
			'code' => '+32',
			'iso'  => 'BE',
		],
		'BZ' => [
			'name' => 'Belize',
			'code' => '+501',
			'iso'  => 'BZ',
		],
		'BJ' => [
			'name' => 'Benin',
			'code' => '+229',
			'iso'  => 'BJ',
		],
		'BM' => [
			'name' => 'Bermuda',
			'code' => '+1441',
			'iso'  => 'BM',
		],
		'BT' => [
			'name' => 'Bhutan',
			'code' => '+975',
			'iso'  => 'BT',
		],
		'BO' => [
			'name' => 'Bolivia, Plurinational State of',
			'code' => '+591',
			'iso'  => 'BO',
		],
		'BA' => [
			'name' => 'Bosnia and Herzegovina',
			'code' => '+387',
			'iso'  => 'BA',
		],
		'BW' => [
			'name' => 'Botswana',
			'code' => '+267',
			'iso'  => 'BW',
		],
		'BR' => [
			'name' => 'Brazil',
			'code' => '+55',
			'iso'  => 'BR',
		],
		'IO' => [
			'name' => 'British Indian Ocean Territory',
			'code' => '+246',
			'iso'  => 'IO',
		],
		'BN' => [
			'name' => 'Brunei Darussalam',
			'code' => '+673',
			'iso'  => 'BN',
		],
		'BG' => [
			'name' => 'Bulgaria',
			'code' => '+359',
			'iso'  => 'BG',
		],
		'BF' => [
			'name' => 'Burkina Faso',
			'code' => '+226',
			'iso'  => 'BF',
		],
		'BI' => [
			'name' => 'Burundi',
			'code' => '+257',
			'iso'  => 'BI',
		],
		'KH' => [
			'name' => 'Cambodia',
			'code' => '+855',
			'iso'  => 'KH',
		],
		'CM' => [
			'name' => 'Cameroon',
			'code' => '+237',
			'iso'  => 'CM',
		],
		'CA' => [
			'name' => 'Canada',
			'code' => '+1',
			'iso'  => 'CA',
		],
		'CV' => [
			'name' => 'Cape Verde',
			'code' => '+238',
			'iso'  => 'CV',
		],
		'KY' => [
			'name' => 'Cayman Islands',
			'code' => '+ 345',
			'iso'  => 'KY',
		],
		'CF' => [
			'name' => 'Central African Republic',
			'code' => '+236',
			'iso'  => 'CF',
		],
		'TD' => [
			'name' => 'Chad',
			'code' => '+235',
			'iso'  => 'TD',
		],
		'CL' => [
			'name' => 'Chile',
			'code' => '+56',
			'iso'  => 'CL',
		],
		'CN' => [
			'name' => 'China',
			'code' => '+86',
			'iso'  => 'CN',
		],
		'CX' => [
			'name' => 'Christmas Island',
			'code' => '+61',
			'iso'  => 'CX',
		],
		'CC' => [
			'name' => 'Cocos (Keeling) Islands',
			'code' => '+61',
			'iso'  => 'CC',
		],
		'CO' => [
			'name' => 'Colombia',
			'code' => '+57',
			'iso'  => 'CO',
		],
		'KM' => [
			'name' => 'Comoros',
			'code' => '+269',
			'iso'  => 'KM',
		],
		'CG' => [
			'name' => 'Congo',
			'code' => '+242',
			'iso'  => 'CG',
		],
		'CD' => [
			'name' => 'Congo, The Democratic Republic of the Congo',
			'code' => '+243',
			'iso'  => 'CD',
		],
		'CK' => [
			'name' => 'Cook Islands',
			'code' => '+682',
			'iso'  => 'CK',
		],
		'CR' => [
			'name' => 'Costa Rica',
			'code' => '+506',
			'iso'  => 'CR',
		],
		'CI' => [
			'name' => 'Cote d\'Ivoire',
			'code' => '+225',
			'iso'  => 'CI',
		],
		'HR' => [
			'name' => 'Croatia',
			'code' => '+385',
			'iso'  => 'HR',
		],
		'CU' => [
			'name' => 'Cuba',
			'code' => '+53',
			'iso'  => 'CU',
		],
		'CY' => [
			'name' => 'Cyprus',
			'code' => '+357',
			'iso'  => 'CY',
		],
		'CZ' => [
			'name' => 'Czech Republic',
			'code' => '+420',
			'iso'  => 'CZ',
		],
		'DK' => [
			'name' => 'Denmark',
			'code' => '+45',
			'iso'  => 'DK',
		],
		'DJ' => [
			'name' => 'Djibouti',
			'code' => '+253',
			'iso'  => 'DJ',
		],
		'DM' => [
			'name' => 'Dominica',
			'code' => '+1767',
			'iso'  => 'DM',
		],
		'DO' => [
			'name' => 'Dominican Republic',
			'code' => '+1849',
			'iso'  => 'DO',
		],
		'EC' => [
			'name' => 'Ecuador',
			'code' => '+593',
			'iso'  => 'EC',
		],
		'EG' => [
			'name' => 'Egypt',
			'code' => '+20',
			'iso'  => 'EG',
		],
		'SV' => [
			'name' => 'El Salvador',
			'code' => '+503',
			'iso'  => 'SV',
		],
		'GQ' => [
			'name' => 'Equatorial Guinea',
			'code' => '+240',
			'iso'  => 'GQ',
		],
		'ER' => [
			'name' => 'Eritrea',
			'code' => '+291',
			'iso'  => 'ER',
		],
		'EE' => [
			'name' => 'Estonia',
			'code' => '+372',
			'iso'  => 'EE',
		],
		'ET' => [
			'name' => 'Ethiopia',
			'code' => '+251',
			'iso'  => 'ET',
		],
		'FK' => [
			'name' => 'Falkland Islands (Malvinas)',
			'code' => '+500',
			'iso'  => 'FK',
		],
		'FO' => [
			'name' => 'Faroe Islands',
			'code' => '+298',
			'iso'  => 'FO',
		],
		'FJ' => [
			'name' => 'Fiji',
			'code' => '+679',
			'iso'  => 'FJ',
		],
		'FI' => [
			'name' => 'Finland',
			'code' => '+358',
			'iso'  => 'FI',
		],
		'FR' => [
			'name' => 'France',
			'code' => '+33',
			'iso'  => 'FR',
		],
		'GF' => [
			'name' => 'French Guiana',
			'code' => '+594',
			'iso'  => 'GF',
		],
		'PF' => [
			'name' => 'French Polynesia',
			'code' => '+689',
			'iso'  => 'PF',
		],
		'GA' => [
			'name' => 'Gabon',
			'code' => '+241',
			'iso'  => 'GA',
		],
		'GM' => [
			'name' => 'Gambia',
			'code' => '+220',
			'iso'  => 'GM',
		],
		'GE' => [
			'name' => 'Georgia',
			'code' => '+995',
			'iso'  => 'GE',
		],
		'DE' => [
			'name' => 'Germany',
			'code' => '+49',
			'iso'  => 'DE',
		],
		'GH' => [
			'name' => 'Ghana',
			'code' => '+233',
			'iso'  => 'GH',
		],
		'GI' => [
			'name' => 'Gibraltar',
			'code' => '+350',
			'iso'  => 'GI',
		],
		'GR' => [
			'name' => 'Greece',
			'code' => '+30',
			'iso'  => 'GR',
		],
		'GL' => [
			'name' => 'Greenland',
			'code' => '+299',
			'iso'  => 'GL',
		],
		'GD' => [
			'name' => 'Grenada',
			'code' => '+1473',
			'iso'  => 'GD',
		],
		'GP' => [
			'name' => 'Guadeloupe',
			'code' => '+590',
			'iso'  => 'GP',
		],
		'GU' => [
			'name' => 'Guam',
			'code' => '+1671',
			'iso'  => 'GU',
		],
		'GT' => [
			'name' => 'Guatemala',
			'code' => '+502',
			'iso'  => 'GT',
		],
		'GG' => [
			'name' => 'Guernsey',
			'code' => '+44',
			'iso'  => 'GG',
		],
		'GN' => [
			'name' => 'Guinea',
			'code' => '+224',
			'iso'  => 'GN',
		],
		'GW' => [
			'name' => 'Guinea-Bissau',
			'code' => '+245',
			'iso'  => 'GW',
		],
		'GY' => [
			'name' => 'Guyana',
			'code' => '+595',
			'iso'  => 'GY',
		],
		'HT' => [
			'name' => 'Haiti',
			'code' => '+509',
			'iso'  => 'HT',
		],
		'VA' => [
			'name' => 'Holy See (Vatican City State)',
			'code' => '+379',
			'iso'  => 'VA',
		],
		'HN' => [
			'name' => 'Honduras',
			'code' => '+504',
			'iso'  => 'HN',
		],
		'HK' => [
			'name' => 'Hong Kong',
			'code' => '+852',
			'iso'  => 'HK',
		],
		'HU' => [
			'name' => 'Hungary',
			'code' => '+36',
			'iso'  => 'HU',
		],
		'IS' => [
			'name' => 'Iceland',
			'code' => '+354',
			'iso'  => 'IS',
		],
		'IN' => [
			'name' => 'India',
			'code' => '+91',
			'iso'  => 'IN',
		],
		'ID' => [
			'name' => 'Indonesia',
			'code' => '+62',
			'iso'  => 'ID',
		],
		'IR' => [
			'name' => 'Iran, Islamic Republic of Persian Gulf',
			'code' => '+98',
			'iso'  => 'IR',
		],
		'IQ' => [
			'name' => 'Iraq',
			'code' => '+964',
			'iso'  => 'IQ',
		],
		'IE' => [
			'name' => 'Ireland',
			'code' => '+353',
			'iso'  => 'IE',
		],
		'IM' => [
			'name' => 'Isle of Man',
			'code' => '+44',
			'iso'  => 'IM',
		],
		'IL' => [
			'name' => 'Israel',
			'code' => '+972',
			'iso'  => 'IL',
		],
		'IT' => [
			'name' => 'Italy',
			'code' => '+39',
			'iso'  => 'IT',
		],
		'JM' => [
			'name' => 'Jamaica',
			'code' => '+1876',
			'iso'  => 'JM',
		],
		'JP' => [
			'name' => 'Japan',
			'code' => '+81',
			'iso'  => 'JP',
		],
		'JE' => [
			'name' => 'Jersey',
			'code' => '+44',
			'iso'  => 'JE',
		],
		'JO' => [
			'name' => 'Jordan',
			'code' => '+962',
			'iso'  => 'JO',
		],
		'KZ' => [
			'name' => 'Kazakhstan',
			'code' => '+77',
			'iso'  => 'KZ',
		],
		'KE' => [
			'name' => 'Kenya',
			'code' => '+254',
			'iso'  => 'KE',
		],
		'KI' => [
			'name' => 'Kiribati',
			'code' => '+686',
			'iso'  => 'KI',
		],
		'KP' => [
			'name' => 'Korea, Democratic People\'s Republic of Korea',
			'code' => '+850',
			'iso'  => 'KP',
		],
		'KR' => [
			'name' => 'Korea, Republic of South Korea',
			'code' => '+82',
			'iso'  => 'KR',
		],
		'KW' => [
			'name' => 'Kuwait',
			'code' => '+965',
			'iso'  => 'KW',
		],
		'KG' => [
			'name' => 'Kyrgyzstan',
			'code' => '+996',
			'iso'  => 'KG',
		],
		'LA' => [
			'name' => 'Laos',
			'code' => '+856',
			'iso'  => 'LA',
		],
		'LV' => [
			'name' => 'Latvia',
			'code' => '+371',
			'iso'  => 'LV',
		],
		'LB' => [
			'name' => 'Lebanon',
			'code' => '+961',
			'iso'  => 'LB',
		],
		'LS' => [
			'name' => 'Lesotho',
			'code' => '+266',
			'iso'  => 'LS',
		],
		'LR' => [
			'name' => 'Liberia',
			'code' => '+231',
			'iso'  => 'LR',
		],
		'LY' => [
			'name' => 'Libyan Arab Jamahiriya',
			'code' => '+218',
			'iso'  => 'LY',
		],
		'LI' => [
			'name' => 'Liechtenstein',
			'code' => '+423',
			'iso'  => 'LI',
		],
		'LT' => [
			'name' => 'Lithuania',
			'code' => '+370',
			'iso'  => 'LT',
		],
		'LU' => [
			'name' => 'Luxembourg',
			'code' => '+352',
			'iso'  => 'LU',
		],
		'MO' => [
			'name' => 'Macao',
			'code' => '+853',
			'iso'  => 'MO',
		],
		'MK' => [
			'name' => 'Macedonia',
			'code' => '+389',
			'iso'  => 'MK',
		],
		'MG' => [
			'name' => 'Madagascar',
			'code' => '+261',
			'iso'  => 'MG',
		],
		'MW' => [
			'name' => 'Malawi',
			'code' => '+265',
			'iso'  => 'MW',
		],
		'MY' => [
			'name' => 'Malaysia',
			'code' => '+60',
			'iso'  => 'MY',
		],
		'MV' => [
			'name' => 'Maldives',
			'code' => '+960',
			'iso'  => 'MV',
		],
		'ML' => [
			'name' => 'Mali',
			'code' => '+223',
			'iso'  => 'ML',
		],
		'MT' => [
			'name' => 'Malta',
			'code' => '+356',
			'iso'  => 'MT',
		],
		'MH' => [
			'name' => 'Marshall Islands',
			'code' => '+692',
			'iso'  => 'MH',
		],
		'MQ' => [
			'name' => 'Martinique',
			'code' => '+596',
			'iso'  => 'MQ',
		],
		'MR' => [
			'name' => 'Mauritania',
			'code' => '+222',
			'iso'  => 'MR',
		],
		'MU' => [
			'name' => 'Mauritius',
			'code' => '+230',
			'iso'  => 'MU',
		],
		'YT' => [
			'name' => 'Mayotte',
			'code' => '+262',
			'iso'  => 'YT',
		],
		'MX' => [
			'name' => 'Mexico',
			'code' => '+52',
			'iso'  => 'MX',
		],
		'FM' => [
			'name' => 'Micronesia, Federated States of Micronesia',
			'code' => '+691',
			'iso'  => 'FM',
		],
		'MD' => [
			'name' => 'Moldova',
			'code' => '+373',
			'iso'  => 'MD',
		],
		'MC' => [
			'name' => 'Monaco',
			'code' => '+377',
			'iso'  => 'MC',
		],
		'MN' => [
			'name' => 'Mongolia',
			'code' => '+976',
			'iso'  => 'MN',
		],
		'ME' => [
			'name' => 'Montenegro',
			'code' => '+382',
			'iso'  => 'ME',
		],
		'MS' => [
			'name' => 'Montserrat',
			'code' => '+1664',
			'iso'  => 'MS',
		],
		'MA' => [
			'name' => 'Morocco',
			'code' => '+212',
			'iso'  => 'MA',
		],
		'MZ' => [
			'name' => 'Mozambique',
			'code' => '+258',
			'iso'  => 'MZ',
		],
		'MM' => [
			'name' => 'Myanmar',
			'code' => '+95',
			'iso'  => 'MM',
		],
		'NA' => [
			'name' => 'Namibia',
			'code' => '+264',
			'iso'  => 'NA',
		],
		'NR' => [
			'name' => 'Nauru',
			'code' => '+674',
			'iso'  => 'NR',
		],
		'NP' => [
			'name' => 'Nepal',
			'code' => '+977',
			'iso'  => 'NP',
		],
		'NL' => [
			'name' => 'Netherlands',
			'code' => '+31',
			'iso'  => 'NL',
		],
		'AN' => [
			'name' => 'Netherlands Antilles',
			'code' => '+599',
			'iso'  => 'AN',
		],
		'NC' => [
			'name' => 'New Caledonia',
			'code' => '+687',
			'iso'  => 'NC',
		],
		'NZ' => [
			'name' => 'New Zealand',
			'code' => '+64',
			'iso'  => 'NZ',
		],
		'NI' => [
			'name' => 'Nicaragua',
			'code' => '+505',
			'iso'  => 'NI',
		],
		'NE' => [
			'name' => 'Niger',
			'code' => '+227',
			'iso'  => 'NE',
		],
		'NG' => [
			'name' => 'Nigeria',
			'code' => '+234',
			'iso'  => 'NG',
		],
		'NU' => [
			'name' => 'Niue',
			'code' => '+683',
			'iso'  => 'NU',
		],
		'NF' => [
			'name' => 'Norfolk Island',
			'code' => '+672',
			'iso'  => 'NF',
		],
		'MP' => [
			'name' => 'Northern Mariana Islands',
			'code' => '+1670',
			'iso'  => 'MP',
		],
		'NO' => [
			'name' => 'Norway',
			'code' => '+47',
			'iso'  => 'NO',
		],
		'OM' => [
			'name' => 'Oman',
			'code' => '+968',
			'iso'  => 'OM',
		],
		'PK' => [
			'name' => 'Pakistan',
			'code' => '+92',
			'iso'  => 'PK',
		],
		'PW' => [
			'name' => 'Palau',
			'code' => '+680',
			'iso'  => 'PW',
		],
		'PS' => [
			'name' => 'Palestinian Territory, Occupied',
			'code' => '+970',
			'iso'  => 'PS',
		],
		'PA' => [
			'name' => 'Panama',
			'code' => '+507',
			'iso'  => 'PA',
		],
		'PG' => [
			'name' => 'Papua New Guinea',
			'code' => '+675',
			'iso'  => 'PG',
		],
		'PY' => [
			'name' => 'Paraguay',
			'code' => '+595',
			'iso'  => 'PY',
		],
		'PE' => [
			'name' => 'Peru',
			'code' => '+51',
			'iso'  => 'PE',
		],
		'PH' => [
			'name' => 'Philippines',
			'code' => '+63',
			'iso'  => 'PH',
		],
		'PN' => [
			'name' => 'Pitcairn',
			'code' => '+872',
			'iso'  => 'PN',
		],
		'PL' => [
			'name' => 'Poland',
			'code' => '+48',
			'iso'  => 'PL',
		],
		'PT' => [
			'name' => 'Portugal',
			'code' => '+351',
			'iso'  => 'PT',
		],
		'PR' => [
			'name' => 'Puerto Rico',
			'code' => '+1939',
			'iso'  => 'PR',
		],
		'QA' => [
			'name' => 'Qatar',
			'code' => '+974',
			'iso'  => 'QA',
		],
		'RO' => [
			'name' => 'Romania',
			'code' => '+40',
			'iso'  => 'RO',
		],
		'RU' => [
			'name' => 'Russia',
			'code' => '+7',
			'iso'  => 'RU',
		],
		'RW' => [
			'name' => 'Rwanda',
			'code' => '+250',
			'iso'  => 'RW',
		],
		'RE' => [
			'name' => 'Reunion',
			'code' => '+262',
			'iso'  => 'RE',
		],
		'BL' => [
			'name' => 'Saint Barthelemy',
			'code' => '+590',
			'iso'  => 'BL',
		],
		'SH' => [
			'name' => 'Saint Helena, Ascension and Tristan Da Cunha',
			'code' => '+290',
			'iso'  => 'SH',
		],
		'KN' => [
			'name' => 'Saint Kitts and Nevis',
			'code' => '+1869',
			'iso'  => 'KN',
		],
		'LC' => [
			'name' => 'Saint Lucia',
			'code' => '+1758',
			'iso'  => 'LC',
		],
		'MF' => [
			'name' => 'Saint Martin',
			'code' => '+590',
			'iso'  => 'MF',
		],
		'PM' => [
			'name' => 'Saint Pierre and Miquelon',
			'code' => '+508',
			'iso'  => 'PM',
		],
		'VC' => [
			'name' => 'Saint Vincent and the Grenadines',
			'code' => '+1784',
			'iso'  => 'VC',
		],
		'WS' => [
			'name' => 'Samoa',
			'code' => '+685',
			'iso'  => 'WS',
		],
		'SM' => [
			'name' => 'San Marino',
			'code' => '+378',
			'iso'  => 'SM',
		],
		'ST' => [
			'name' => 'Sao Tome and Principe',
			'code' => '+239',
			'iso'  => 'ST',
		],
		'SA' => [
			'name' => 'Saudi Arabia',
			'code' => '+966',
			'iso'  => 'SA',
		],
		'SN' => [
			'name' => 'Senegal',
			'code' => '+221',
			'iso'  => 'SN',
		],
		'RS' => [
			'name' => 'Serbia',
			'code' => '+381',
			'iso'  => 'RS',
		],
		'SC' => [
			'name' => 'Seychelles',
			'code' => '+248',
			'iso'  => 'SC',
		],
		'SL' => [
			'name' => 'Sierra Leone',
			'code' => '+232',
			'iso'  => 'SL',
		],
		'SG' => [
			'name' => 'Singapore',
			'code' => '+65',
			'iso'  => 'SG',
		],
		'SK' => [
			'name' => 'Slovakia',
			'code' => '+421',
			'iso'  => 'SK',
		],
		'SI' => [
			'name' => 'Slovenia',
			'code' => '+386',
			'iso'  => 'SI',
		],
		'SB' => [
			'name' => 'Solomon Islands',
			'code' => '+677',
			'iso'  => 'SB',
		],
		'SO' => [
			'name' => 'Somalia',
			'code' => '+252',
			'iso'  => 'SO',
		],
		'ZA' => [
			'name' => 'South Africa',
			'code' => '+27',
			'iso'  => 'ZA',
		],
		'SS' => [
			'name' => 'South Sudan',
			'code' => '+211',
			'iso'  => 'SS',
		],
		'GS' => [
			'name' => 'South Georgia and the South Sandwich Islands',
			'code' => '+500',
			'iso'  => 'GS',
		],
		'ES' => [
			'name' => 'Spain',
			'code' => '+34',
			'iso'  => 'ES',
		],
		'LK' => [
			'name' => 'Sri Lanka',
			'code' => '+94',
			'iso'  => 'LK',
		],
		'SD' => [
			'name' => 'Sudan',
			'code' => '+249',
			'iso'  => 'SD',
		],
		'SR' => [
			'name' => 'Suriname',
			'code' => '+597',
			'iso'  => 'SR',
		],
		'SJ' => [
			'name' => 'Svalbard and Jan Mayen',
			'code' => '+47',
			'iso'  => 'SJ',
		],
		'SZ' => [
			'name' => 'Swaziland',
			'code' => '+268',
			'iso'  => 'SZ',
		],
		'SE' => [
			'name' => 'Sweden',
			'code' => '+46',
			'iso'  => 'SE',
		],
		'CH' => [
			'name' => 'Switzerland',
			'code' => '+41',
			'iso'  => 'CH',
		],
		'SY' => [
			'name' => 'Syrian Arab Republic',
			'code' => '+963',
			'iso'  => 'SY',
		],
		'TW' => [
			'name' => 'Taiwan',
			'code' => '+886',
			'iso'  => 'TW',
		],
		'TJ' => [
			'name' => 'Tajikistan',
			'code' => '+992',
			'iso'  => 'TJ',
		],
		'TZ' => [
			'name' => 'Tanzania, United Republic of Tanzania',
			'code' => '+255',
			'iso'  => 'TZ',
		],
		'TH' => [
			'name' => 'Thailand',
			'code' => '+66',
			'iso'  => 'TH',
		],
		'TL' => [
			'name' => 'Timor-Leste',
			'code' => '+670',
			'iso'  => 'TL',
		],
		'TG' => [
			'name' => 'Togo',
			'code' => '+228',
			'iso'  => 'TG',
		],
		'TK' => [
			'name' => 'Tokelau',
			'code' => '+690',
			'iso'  => 'TK',
		],
		'TO' => [
			'name' => 'Tonga',
			'code' => '+676',
			'iso'  => 'TO',
		],
		'TT' => [
			'name' => 'Trinidad and Tobago',
			'code' => '+1868',
			'iso'  => 'TT',
		],
		'TN' => [
			'name' => 'Tunisia',
			'code' => '+216',
			'iso'  => 'TN',
		],
		'TR' => [
			'name' => 'Turkey',
			'code' => '+90',
			'iso'  => 'TR',
		],
		'TM' => [
			'name' => 'Turkmenistan',
			'code' => '+993',
			'iso'  => 'TM',
		],
		'TC' => [
			'name' => 'Turks and Caicos Islands',
			'code' => '+1649',
			'iso'  => 'TC',
		],
		'TV' => [
			'name' => 'Tuvalu',
			'code' => '+688',
			'iso'  => 'TV',
		],
		'UG' => [
			'name' => 'Uganda',
			'code' => '+256',
			'iso'  => 'UG',
		],
		'UA' => [
			'name' => 'Ukraine',
			'code' => '+380',
			'iso'  => 'UA',
		],
		'AE' => [
			'name' => 'United Arab Emirates',
			'code' => '+971',
			'iso'  => 'AE',
		],
		'GB' => [
			'name' => 'United Kingdom',
			'code' => '+44',
			'iso'  => 'GB',
		],
		'US' => [
			'name' => 'United States',
			'code' => '+1',
			'iso'  => 'US',
		],
		'UY' => [
			'name' => 'Uruguay',
			'code' => '+598',
			'iso'  => 'UY',
		],
		'UZ' => [
			'name' => 'Uzbekistan',
			'code' => '+998',
			'iso'  => 'UZ',
		],
		'VU' => [
			'name' => 'Vanuatu',
			'code' => '+678',
			'iso'  => 'VU',
		],
		'VE' => [
			'name' => 'Venezuela, Bolivarian Republic of Venezuela',
			'code' => '+58',
			'iso'  => 'VE',
		],
		'VN' => [
			'name' => 'Vietnam',
			'code' => '+84',
			'iso'  => 'VN',
		],
		'VG' => [
			'name' => 'Virgin Islands, British',
			'code' => '+1284',
			'iso'  => 'VG',
		],
		'VI' => [
			'name' => 'Virgin Islands, U.S.',
			'code' => '+1340',
			'iso'  => 'VI',
		],
		'WF' => [
			'name' => 'Wallis and Futuna',
			'code' => '+681',
			'iso'  => 'WF',
		],
		'YE' => [
			'name' => 'Yemen',
			'code' => '+967',
			'iso'  => 'YE',
		],
		'ZM' => [
			'name' => 'Zambia',
			'code' => '+260',
			'iso'  => 'ZM',
		],
		'ZW' => [
			'name' => 'Zimbabwe',
			'code' => '+263',
			'iso'  => 'ZW',
		],
	];

	const DEFAULT_CURRENCIES = [
		'USD',
		'EUR',
	];

	const CURRENCIES = [
		'AED' => 'United Arab Emirates Dirham',
		'AFN' => 'Afghanistan Afghani',
		'ALL' => 'Albania Lek',
		'AMD' => 'Armenia Dram',
		'ANG' => 'Netherlands Antilles Guilder',
		'AOA' => 'Angola Kwanza',
		'ARS' => 'Argentina Peso',
		'AUD' => 'Australia Dollar',
		'AWG' => 'Aruba Guilder',
		'AZN' => 'Azerbaijan Manat',
		'BAM' => 'Bosnia and Herzegovina Convertible Mark',
		'BBD' => 'Barbados Dollar',
		'BDT' => 'Bangladesh Taka',
		'BGN' => 'Bulgaria Lev',
		'BHD' => 'Bahrain Dinar',
		'BIF' => 'Burundi Franc',
		'BMD' => 'Bermuda Dollar',
		'BND' => 'Brunei Darussalam Dollar',
		'BOB' => 'Bolivia Bolíviano',
		'BRL' => 'Brazil Real',
		'BSD' => 'Bahamas Dollar',
		'BTN' => 'Bhutan Ngultrum',
		'BWP' => 'Botswana Pula',
		'BYN' => 'Belarus Ruble',
		'BZD' => 'Belize Dollar',
		'CAD' => 'Canada Dollar',
		'CDF' => 'Congo/Kinshasa Franc',
		'CHF' => 'Switzerland Franc',
		'CLP' => 'Chile Peso',
		'CNY' => 'China Yuan Renminbi',
		'COP' => 'Colombia Peso',
		'CRC' => 'Costa Rica Colon',
		'CUC' => 'Cuba Convertible Peso',
		'CUP' => 'Cuba Peso',
		'CVE' => 'Cape Verde Escudo',
		'CZK' => 'Czech Republic Koruna',
		'DJF' => 'Djibouti Franc',
		'DKK' => 'Denmark Krone',
		'DOP' => 'Dominican Republic Peso',
		'DZD' => 'Algeria Dinar',
		'EGP' => 'Egypt Pound',
		'ERN' => 'Eritrea Nakfa',
		'ETB' => 'Ethiopia Birr',
		'EUR' => 'Euro Member Countries',
		'FJD' => 'Fiji Dollar',
		'FKP' => 'Falkland Islands (Malvinas) Pound',
		'GBP' => 'United Kingdom Pound',
		'GEL' => 'Georgia Lari',
		'GGP' => 'Guernsey Pound',
		'GHS' => 'Ghana Cedi',
		'GIP' => 'Gibraltar Pound',
		'GMD' => 'Gambia Dalasi',
		'GNF' => 'Guinea Franc',
		'GTQ' => 'Guatemala Quetzal',
		'GYD' => 'Guyana Dollar',
		'HKD' => 'Hong Kong Dollar',
		'HNL' => 'Honduras Lempira',
		'HRK' => 'Croatia Kuna',
		'HTG' => 'Haiti Gourde',
		'HUF' => 'Hungary Forint',
		'IDR' => 'Indonesia Rupiah',
		'ILS' => 'Israel Shekel',
		'IMP' => 'Isle of Man Pound',
		'INR' => 'India Rupee',
		'IQD' => 'Iraq Dinar',
		'IRR' => 'Iran Rial',
		'ISK' => 'Iceland Krona',
		'JEP' => 'Jersey Pound',
		'JMD' => 'Jamaica Dollar',
		'JOD' => 'Jordan Dinar',
		'JPY' => 'Japan Yen',
		'KES' => 'Kenya Shilling',
		'KGS' => 'Kyrgyzstan Som',
		'KHR' => 'Cambodia Riel',
		'KMF' => 'Comorian Franc',
		'KPW' => 'Korea (North) Won',
		'KRW' => 'Korea (South) Won',
		'KWD' => 'Kuwait Dinar',
		'KYD' => 'Cayman Islands Dollar',
		'KZT' => 'Kazakhstan Tenge',
		'LAK' => 'Laos Kip',
		'LBP' => 'Lebanon Pound',
		'LKR' => 'Sri Lanka Rupee',
		'LRD' => 'Liberia Dollar',
		'LSL' => 'Lesotho Loti',
		'LYD' => 'Libya Dinar',
		'MAD' => 'Morocco Dirham',
		'MDL' => 'Moldova Leu',
		'MGA' => 'Madagascar Ariary',
		'MKD' => 'Macedonia Denar',
		'MMK' => 'Myanmar (Burma) Kyat',
		'MNT' => 'Mongolia Tughrik',
		'MOP' => 'Macau Pataca',
		'MRU' => 'Mauritania Ouguiya',
		'MUR' => 'Mauritius Rupee',
		'MVR' => 'Maldives (Maldive Islands) Rufiyaa',
		'MWK' => 'Malawi Kwacha',
		'MXN' => 'Mexico Peso',
		'MYR' => 'Malaysia Ringgit',
		'MZN' => 'Mozambique Metical',
		'NAD' => 'Namibia Dollar',
		'NGN' => 'Nigeria Naira',
		'NIO' => 'Nicaragua Cordoba',
		'NOK' => 'Norway Krone',
		'NPR' => 'Nepal Rupee',
		'NZD' => 'New Zealand Dollar',
		'OMR' => 'Oman Rial',
		'PAB' => 'Panama Balboa',
		'PEN' => 'Peru Sol',
		'PGK' => 'Papua New Guinea Kina',
		'PHP' => 'Philippines Peso',
		'PKR' => 'Pakistan Rupee',
		'PLN' => 'Poland Zloty',
		'PYG' => 'Paraguay Guarani',
		'QAR' => 'Qatar Riyal',
		'RON' => 'Romania Leu',
		'RSD' => 'Serbia Dinar',
		'RUB' => 'Russia Ruble',
		'RWF' => 'Rwanda Franc',
		'SAR' => 'Saudi Arabia Riyal',
		'SBD' => 'Solomon Islands Dollar',
		'SCR' => 'Seychelles Rupee',
		'SDG' => 'Sudan Pound',
		'SEK' => 'Sweden Krona',
		'SGD' => 'Singapore Dollar',
		'SHP' => 'Saint Helena Pound',
		'SLL' => 'Sierra Leone Leone',
		'SOS' => 'Somalia Shilling',
		'SRD' => 'Suriname Dollar',
		'STN' => 'São Tomé and Príncipe Dobra',
		'SVC' => 'El Salvador Colon',
		'SYP' => 'Syria Pound',
		'SZL' => 'eSwatini Lilangeni',
		'THB' => 'Thailand Baht',
		'TJS' => 'Tajikistan Somoni',
		'TMT' => 'Turkmenistan Manat',
		'TND' => 'Tunisia Dinar',
		'TOP' => 'Tonga Pa\'anga',
		'TRY' => 'Turkey Lira',
		'TTD' => 'Trinidad and Tobago Dollar',
		'TVD' => 'Tuvalu Dollar',
		'TWD' => 'Taiwan New Dollar',
		'TZS' => 'Tanzania Shilling',
		'UAH' => 'Ukraine Hryvnia',
		'UGX' => 'Uganda Shilling',
		'USD' => 'United States Dollar',
		'UYU' => 'Uruguay Peso',
		'UZS' => 'Uzbekistan Som',
		'VEF' => 'Venezuela Bolívar',
		'VND' => 'Viet Nam Dong',
		'VUV' => 'Vanuatu Vatu',
		'WST' => 'Samoa Tala',
		'XAF' => 'Communauté Financière Africaine (BEAC) CFA Franc BEAC',
		'XCD' => 'East Caribbean Dollar',
		'XDR' => 'International Monetary Fund (IMF) Special Drawing Rights',
		'XOF' => 'Communauté Financière Africaine (BCEAO) Franc',
		'XPF' => 'Comptoirs Français du Pacifique (CFP) Franc',
		'YER' => 'Yemen Rial',
		'ZAR' => 'South Africa Rand',
		'ZMW' => 'Zambia Kwacha',
		'ZWD' => 'Zimbabwe Dollar',
	];

	public static function get_default_country(): array {
		$current_country = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? false;
		$result          = [
			'country'     => self::COUNTRIES['AF'],
			'not_allowed' => false,
		];

		if ( ! $current_country ) {
			return $result;
		}

		foreach ( self::COUNTRIES as $iso => $country ) {
			if ( $current_country === $iso ) {
				$result['country'] = $country;
				return $result;
			}
		}

		$result['not_allowed'] = true;
		return $result;
	}

	public static function get_iso_by_country_name( string $country_name ): ?string {
		if ( ! $country_name ) {
			return null;
		}

		foreach ( self::COUNTRIES as $iso => $country_data ) {
			if ( $country_name === $country_data['name'] ) {
				return $iso;
			}
		}

		return null;
	}

}
