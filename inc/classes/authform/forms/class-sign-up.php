<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\traits\Singleton;

class Sign_Up extends Baseform {

	use Singleton;

	const TEMPLATE_NAME = 'sign-up';

	const COUNTRIES = [
		[
			'name' => 'Afghanistan',
			'iso'  => 'AF',
			'code' => '93',
		],
		[
			'name' => 'Albania',
			'iso'  => 'AL',
			'code' => '355',
		],
		[
			'name' => 'Algeria',
			'iso'  => 'DZ',
			'code' => '213',
		],
		[
			'name' => 'Andorra',
			'iso'  => 'AD',
			'code' => '376',
		],
		[
			'name' => 'Angola',
			'iso'  => 'AO',
			'code' => '244',
		],
		[
			'name' => 'Antigua and Barbuda',
			'iso'  => 'AG',
			'code' => '-267',
		],
		[
			'name' => 'Argentina',
			'iso'  => 'AR',
			'code' => '54',
		],
		[
			'name' => 'Armenia',
			'iso'  => 'AM',
			'code' => '374',
		],
		[
			'name' => 'Australia',
			'iso'  => 'AU',
			'code' => '61',
		],
		[
			'name' => 'Azerbaijan',
			'iso'  => 'AZ',
			'code' => '994',
		],
		[
			'name' => 'Bahamas, The',
			'iso'  => 'BS',
			'code' => '-241',
		],
		[
			'name' => 'Bahrain',
			'iso'  => 'BH',
			'code' => '973',
		],
		[
			'name' => 'Bangladesh',
			'iso'  => 'BD',
			'code' => '880',
		],
		[
			'name' => 'Barbados',
			'iso'  => 'BB',
			'code' => '-245',
		],
		[
			'name' => 'Belarus',
			'iso'  => 'BY',
			'code' => '375',
		],
		[
			'name' => 'Belize',
			'iso'  => 'BZ',
			'code' => '501',
		],
		[
			'name' => 'Benin',
			'iso'  => 'BJ',
			'code' => '229',
		],
		[
			'name' => 'Bhutan',
			'iso'  => 'BT',
			'code' => '975',
		],
		[
			'name' => 'Bolivia',
			'iso'  => 'BO',
			'code' => '591',
		],
		[
			'name' => 'Bosnia and Herzegovina',
			'iso'  => 'BA',
			'code' => '387',
		],
		[
			'name' => 'Botswana',
			'iso'  => 'BW',
			'code' => '267',
		],
		[
			'name' => 'Brazil',
			'iso'  => 'BR',
			'code' => '55',
		],
		[
			'name' => 'Brunei',
			'iso'  => 'BN',
			'code' => '673',
		],
		[
			'name' => 'Burkina Faso',
			'iso'  => 'BF',
			'code' => '226',
		],
		[
			'name' => 'Burundi',
			'iso'  => 'BI',
			'code' => '257',
		],
		[
			'name' => 'Cambodia',
			'iso'  => 'KH',
			'code' => '855',
		],
		[
			'name' => 'Cameroon',
			'iso'  => 'CM',
			'code' => '237',
		],
		[
			'name' => 'Canada',
			'iso'  => 'CA',
			'code' => '1',
		],
		[
			'name' => 'Cape Verde',
			'iso'  => 'CV',
			'code' => '238',
		],
		[
			'name' => 'Central African Republic',
			'iso'  => 'CF',
			'code' => '236',
		],
		[
			'name' => 'Chad',
			'iso'  => 'TD',
			'code' => '235',
		],
		[
			'name' => 'Chile',
			'iso'  => 'CL',
			'code' => '56',
		],
		[
			'name' => "China, People's Republic of",
			'iso'  => 'CN',
			'code' => '86',
		],
		[
			'name' => 'Colombia',
			'iso'  => 'CO',
			'code' => '57',
		],
		[
			'name' => 'Comoros',
			'iso'  => 'KM',
			'code' => '269',
		],
		[
			'name' => 'Congo, (Congo Kinshasa)',
			'iso'  => 'CD',
			'code' => '243',
		],
		[
			'name' => 'Congo, (Congo Brazzaville)',
			'iso'  => 'CG',
			'code' => '242',
		],
		[
			'name' => 'Costa Rica',
			'iso'  => 'CR',
			'code' => '506',
		],
		[
			'name' => "Cote d'Ivoire (Ivory Coast)",
			'iso'  => 'CI',
			'code' => '225',
		],
		[
			'name' => 'Cuba',
			'iso'  => 'CU',
			'code' => '53',
		],
		[
			'name' => 'Djibouti',
			'iso'  => 'DJ',
			'code' => '253',
		],
		[
			'name' => 'Dominica',
			'iso'  => 'DM',
			'code' => '-766',
		],
		[
			'name' => 'Dominican Republic',
			'iso'  => 'DO',
			'code' => '1829',
		],
		[
			'name' => 'Ecuador',
			'iso'  => 'EC',
			'code' => '593',
		],
		[
			'name' => 'Egypt',
			'iso'  => 'EG',
			'code' => '20',
		],
		[
			'name' => 'El Salvador',
			'iso'  => 'SV',
			'code' => '503',
		],
		[
			'name' => 'Equatorial Guinea',
			'iso'  => 'GQ',
			'code' => '240',
		],
		[
			'name' => 'Eritrea',
			'iso'  => 'ER',
			'code' => '291',
		],
		[
			'name' => 'Ethiopia',
			'iso'  => 'ET',
			'code' => '251',
		],
		[
			'name' => 'Fiji',
			'iso'  => 'FJ',
			'code' => '679',
		],
		[
			'name' => 'Gabon',
			'iso'  => 'GA',
			'code' => '241',
		],
		[
			'name' => 'Gambia, The',
			'iso'  => 'GM',
			'code' => '220',
		],
		[
			'name' => 'Georgia',
			'iso'  => 'GE',
			'code' => '995',
		],
		[
			'name' => 'Ghana',
			'iso'  => 'GH',
			'code' => '233',
		],
		[
			'name' => 'Grenada',
			'iso'  => 'GD',
			'code' => '-472',
		],
		[
			'name' => 'Guatemala',
			'iso'  => 'GT',
			'code' => '502',
		],
		[
			'name' => 'Guinea',
			'iso'  => 'GN',
			'code' => '224',
		],
		[
			'name' => 'Guinea-Bissau',
			'iso'  => 'GW',
			'code' => '245',
		],
		[
			'name' => 'Guyana',
			'iso'  => 'GY',
			'code' => '592',
		],
		[
			'name' => 'Haiti',
			'iso'  => 'HT',
			'code' => '509',
		],
		[
			'name' => 'Honduras',
			'iso'  => 'HN',
			'code' => '504',
		],
		[
			'name' => 'India',
			'iso'  => 'IN',
			'code' => '91',
		],
		[
			'name' => 'Indonesia',
			'iso'  => 'ID',
			'code' => '62',
		],
		[
			'name' => 'Iraq',
			'iso'  => 'IQ',
			'code' => '964',
		],
		[
			'name' => 'Jamaica',
			'iso'  => 'JM',
			'code' => '-875',
		],
		[
			'name' => 'Japan',
			'iso'  => 'JP',
			'code' => '81',
		],
		[
			'name' => 'Jordan',
			'iso'  => 'JO',
			'code' => '962',
		],
		[
			'name' => 'Kazakhstan',
			'iso'  => 'KZ',
			'code' => '7',
		],
		[
			'name' => 'Kenya',
			'iso'  => 'KE',
			'code' => '254',
		],
		[
			'name' => 'Kiribati',
			'iso'  => 'KI',
			'code' => '686',
		],
		[
			'name' => 'Korea, North',
			'iso'  => 'KP',
			'code' => '850',
		],
		[
			'name' => 'Korea, South',
			'iso'  => 'KR',
			'code' => '82',
		],
		[
			'name' => 'Kuwait',
			'iso'  => 'KW',
			'code' => '965',
		],
		[
			'name' => 'Kyrgyzstan',
			'iso'  => 'KG',
			'code' => '996',
		],
		[
			'name' => 'Laos',
			'iso'  => 'LA',
			'code' => '856',
		],
		[
			'name' => 'Lebanon',
			'iso'  => 'LB',
			'code' => '961',
		],
		[
			'name' => 'Lesotho',
			'iso'  => 'LS',
			'code' => '266',
		],
		[
			'name' => 'Liberia',
			'iso'  => 'LR',
			'code' => '231',
		],
		[
			'name' => 'Libya',
			'iso'  => 'LY',
			'code' => '218',
		],
		[
			'name' => 'Liechtenstein',
			'iso'  => 'LI',
			'code' => '423',
		],
		[
			'name' => 'Macedonia',
			'iso'  => 'MK',
			'code' => '389',
		],
		[
			'name' => 'Madagascar',
			'iso'  => 'MG',
			'code' => '261',
		],
		[
			'name' => 'Malawi',
			'iso'  => 'MW',
			'code' => '265',
		],
		[
			'name' => 'Malaysia',
			'iso'  => 'MY',
			'code' => '60',
		],
		[
			'name' => 'Maldives',
			'iso'  => 'MV',
			'code' => '960',
		],
		[
			'name' => 'Mali',
			'iso'  => 'ML',
			'code' => '223',
		],
		[
			'name' => 'Marshall Islands',
			'iso'  => 'MH',
			'code' => '692',
		],
		[
			'name' => 'Mauritania',
			'iso'  => 'MR',
			'code' => '222',
		],
		[
			'name' => 'Mauritius',
			'iso'  => 'MU',
			'code' => '230',
		],
		[
			'name' => 'Mexico',
			'iso'  => 'MX',
			'code' => '52',
		],
		[
			'name' => 'Micronesia',
			'iso'  => 'FM',
			'code' => '691',
		],
		[
			'name' => 'Moldova',
			'iso'  => 'MD',
			'code' => '373',
		],
		[
			'name' => 'Monaco',
			'iso'  => 'MC',
			'code' => '377',
		],
		[
			'name' => 'Mongolia',
			'iso'  => 'MN',
			'code' => '976',
		],
		[
			'name' => 'Montenegro',
			'iso'  => 'ME',
			'code' => '382',
		],
		[
			'name' => 'Morocco',
			'iso'  => 'MA',
			'code' => '212',
		],
		[
			'name' => 'Mozambique',
			'iso'  => 'MZ',
			'code' => '258',
		],
		[
			'name' => 'Myanmar (Burma)',
			'iso'  => 'MM',
			'code' => '95',
		],
		[
			'name' => 'Namibia',
			'iso'  => 'NA',
			'code' => '264',
		],
		[
			'name' => 'Nauru',
			'iso'  => 'NR',
			'code' => '674',
		],
		[
			'name' => 'Nepal',
			'iso'  => 'NP',
			'code' => '977',
		],
		[
			'name' => 'New Zealand',
			'iso'  => 'NZ',
			'code' => '64',
		],
		[
			'name' => 'Nicaragua',
			'iso'  => 'NI',
			'code' => '505',
		],
		[
			'name' => 'Niger',
			'iso'  => 'NE',
			'code' => '227',
		],
		[
			'name' => 'Nigeria',
			'iso'  => 'NG',
			'code' => '234',
		],
		[
			'name' => 'Norway',
			'iso'  => 'NO',
			'code' => '47',
		],
		[
			'name' => 'Oman',
			'iso'  => 'OM',
			'code' => '968',
		],
		[
			'name' => 'Pakistan',
			'iso'  => 'PK',
			'code' => '92',
		],
		[
			'name' => 'Palau',
			'iso'  => 'PW',
			'code' => '680',
		],
		[
			'name' => 'Panama',
			'iso'  => 'PA',
			'code' => '507',
		],
		[
			'name' => 'Papua New Guinea',
			'iso'  => 'PG',
			'code' => '675',
		],
		[
			'name' => 'Paraguay',
			'iso'  => 'PY',
			'code' => '595',
		],
		[
			'name' => 'Peru',
			'iso'  => 'PE',
			'code' => '51',
		],
		[
			'name' => 'Philippines',
			'iso'  => 'PH',
			'code' => '63',
		],
		[
			'name' => 'Qatar',
			'iso'  => 'QA',
			'code' => '974',
		],
		[
			'name' => 'Russia',
			'iso'  => 'RU',
			'code' => '7',
		],
		[
			'name' => 'Rwanda',
			'iso'  => 'RW',
			'code' => '250',
		],
		[
			'name' => 'Saint Kitts and Nevis',
			'iso'  => 'KN',
			'code' => '-868',
		],
		[
			'name' => 'Saint Lucia',
			'iso'  => 'LC',
			'code' => '-757',
		],
		[
			'name' => 'Saint Vincent and the Grenadines',
			'iso'  => 'VC',
			'code' => '-783',
		],
		[
			'name' => 'Samoa',
			'iso'  => 'WS',
			'code' => '685',
		],
		[
			'name' => 'San Marino',
			'iso'  => 'SM',
			'code' => '378',
		],
		[
			'name' => 'Sao Tome and Principe',
			'iso'  => 'ST',
			'code' => '239',
		],
		[
			'name' => 'Saudi Arabia',
			'iso'  => 'SA',
			'code' => '966',
		],
		[
			'name' => 'Senegal',
			'iso'  => 'SN',
			'code' => '221',
		],
		[
			'name' => 'Serbia',
			'iso'  => 'RS',
			'code' => '381',
		],
		[
			'name' => 'Seychelles',
			'iso'  => 'SC',
			'code' => '248',
		],
		[
			'name' => 'Sierra Leone',
			'iso'  => 'SL',
			'code' => '232',
		],
		[
			'name' => 'Singapore',
			'iso'  => 'SG',
			'code' => '65',
		],
		[
			'name' => 'Solomon Islands',
			'iso'  => 'SB',
			'code' => '677',
		],
		[
			'name' => 'Somalia',
			'iso'  => 'SO',
			'code' => '252',
		],
		[
			'name' => 'South Africa',
			'iso'  => 'ZA',
			'code' => '27',
		],
		[
			'name' => 'Sri Lanka',
			'iso'  => 'LK',
			'code' => '94',
		],
		[
			'name' => 'Sudan',
			'iso'  => 'SD',
			'code' => '249',
		],
		[
			'name' => 'Suriname',
			'iso'  => 'SR',
			'code' => '597',
		],
		[
			'name' => 'Swaziland',
			'iso'  => 'SZ',
			'code' => '268',
		],
		[
			'name' => 'Switzerland',
			'iso'  => 'CH',
			'code' => '41',
		],
		[
			'name' => 'Syria',
			'iso'  => 'SY',
			'code' => '963',
		],
		[
			'name' => 'Tajikistan',
			'iso'  => 'TJ',
			'code' => '992',
		],
		[
			'name' => 'Tanzania',
			'iso'  => 'TZ',
			'code' => '255',
		],
		[
			'name' => 'Thailand',
			'iso'  => 'TH',
			'code' => '66',
		],
		[
			'name' => 'Timor-Leste (East Timor)',
			'iso'  => 'TL',
			'code' => '670',
		],
		[
			'name' => 'Togo',
			'iso'  => 'TG',
			'code' => '228',
		],
		[
			'name' => 'Tonga',
			'iso'  => 'TO',
			'code' => '676',
		],
		[
			'name' => 'Trinidad and Tobago',
			'iso'  => 'TT',
			'code' => '-867',
		],
		[
			'name' => 'Tunisia',
			'iso'  => 'TN',
			'code' => '216',
		],
		[
			'name' => 'Turkey',
			'iso'  => 'TR',
			'code' => '90',
		],
		[
			'name' => 'Turkmenistan',
			'iso'  => 'TM',
			'code' => '993',
		],
		[
			'name' => 'Tuvalu',
			'iso'  => 'TV',
			'code' => '688',
		],
		[
			'name' => 'Uganda',
			'iso'  => 'UG',
			'code' => '256',
		],
		[
			'name' => 'Ukraine',
			'iso'  => 'UA',
			'code' => '380',
		],
		[
			'name' => 'United Arab Emirates',
			'iso'  => 'AE',
			'code' => '971',
		],
		[
			'name' => 'United Kingdom',
			'iso'  => 'GB',
			'code' => '44',
		],
		[
			'name' => 'Uruguay',
			'iso'  => 'UY',
			'code' => '598',
		],
		[
			'name' => 'Uzbekistan',
			'iso'  => 'UZ',
			'code' => '998',
		],
		[
			'name' => 'Vanuatu',
			'iso'  => 'VU',
			'code' => '678',
		],
		[
			'name' => 'Venezuela',
			'iso'  => 'VE',
			'code' => '58',
		],
		[
			'name' => 'Vietnam',
			'iso'  => 'VN',
			'code' => '84',
		],
		[
			'name' => 'Yemen',
			'iso'  => 'YE',
			'code' => '967',
		],
		[
			'name' => 'Zambia',
			'iso'  => 'ZM',
			'code' => '260',
		],
		[
			'name' => 'Zimbabwe',
			'iso'  => 'ZW',
			'code' => '263',
		],
		[
			'name' => 'Abkhazia',
			'iso'  => 'GE',
			'code' => '995',
		],
		[
			'name' => 'China, Republic of (Taiwan)',
			'iso'  => 'TW',
			'code' => '886',
		],
		[
			'name' => 'Nagorno-Karabakh',
			'iso'  => 'AZ',
			'code' => '277',
		],
		[
			'name' => 'Northern Cyprus',
			'iso'  => 'CY',
			'code' => '-302',
		],
		[
			'name' => 'Pridnestrovie (Transnistria)',
			'iso'  => 'MD',
			'code' => '-160',
		],
		[
			'name' => 'Somaliland',
			'iso'  => 'SO',
			'code' => '252',
		],
		[
			'name' => 'South Ossetia',
			'iso'  => 'GE',
			'code' => '995',
		],
		[
			'name' => 'Christmas Island',
			'iso'  => 'CX',
			'code' => '61',
		],
		[
			'name' => 'Cocos (Keeling) Islands',
			'iso'  => 'CC',
			'code' => '61',
		],
		[
			'name' => 'Heard Island and McDonald Islands',
			'iso'  => 'HM',
			'code' => '0',
		],
		[
			'name' => 'Norfolk Island',
			'iso'  => 'NF',
			'code' => '672',
		],
		[
			'name' => 'New Caledonia',
			'iso'  => 'NC',
			'code' => '687',
		],
		[
			'name' => 'French Polynesia',
			'iso'  => 'PF',
			'code' => '689',
		],
		[
			'name' => 'Mayotte',
			'iso'  => 'YT',
			'code' => '262',
		],
		[
			'name' => 'Saint Barthelemy',
			'iso'  => 'GP',
			'code' => '590',
		],
		[
			'name' => 'Saint Martin',
			'iso'  => 'GP',
			'code' => '590',
		],
		[
			'name' => 'Saint Pierre and Miquelon',
			'iso'  => 'PM',
			'code' => '508',
		],
		[
			'name' => 'Wallis and Futuna',
			'iso'  => 'WF',
			'code' => '681',
		],
		[
			'name' => 'French Southern and Antarctic Lands',
			'iso'  => 'TF',
			'code' => '0',
		],
		[
			'name' => 'Clipperton Island',
			'iso'  => 'PF',
			'code' => '0',
		],
		[
			'name' => 'Bouvet Island',
			'iso'  => 'BV',
			'code' => '0',
		],
		[
			'name' => 'Cook Islands',
			'iso'  => 'CK',
			'code' => '682',
		],
		[
			'name' => 'Niue',
			'iso'  => 'NU',
			'code' => '683',
		],
		[
			'name' => 'Tokelau',
			'iso'  => 'TK',
			'code' => '690',
		],
		[
			'name' => 'Guernsey',
			'iso'  => 'GG',
			'code' => '44',
		],
		[
			'name' => 'Isle of Man',
			'iso'  => 'IM',
			'code' => '44',
		],
		[
			'name' => 'Jersey',
			'iso'  => 'JE',
			'code' => '44',
		],
		[
			'name' => 'Anguilla',
			'iso'  => 'AI',
			'code' => '-263',
		],
		[
			'name' => 'Bermuda',
			'iso'  => 'BM',
			'code' => '-440',
		],
		[
			'name' => 'British Indian Ocean Territory',
			'iso'  => 'IO',
			'code' => '246',
		],
		[
			'name' => 'British Virgin Islands',
			'iso'  => 'VG',
			'code' => '-283',
		],
		[
			'name' => 'Cayman Islands',
			'iso'  => 'KY',
			'code' => '-344',
		],
		[
			'name' => 'Falkland Islands (Islas Malvinas)',
			'iso'  => 'FK',
			'code' => '500',
		],
		[
			'name' => 'Gibraltar',
			'iso'  => 'GI',
			'code' => '350',
		],
		[
			'name' => 'Montserrat',
			'iso'  => 'MS',
			'code' => '-663',
		],
		[
			'name' => 'Pitcairn Islands',
			'iso'  => 'PN',
			'code' => '0',
		],
		[
			'name' => 'Saint Helena',
			'iso'  => 'SH',
			'code' => '290',
		],
		[
			'name' => 'South Georgia & South Sandwich Islands',
			'iso'  => 'GS',
			'code' => '0',
		],
		[
			'name' => 'Turks and Caicos Islands',
			'iso'  => 'TC',
			'code' => '-648',
		],
		[
			'name' => 'Northern Mariana Islands',
			'iso'  => 'MP',
			'code' => '-669',
		],
		[
			'name' => 'Puerto Rico',
			'iso'  => 'PR',
			'code' => '787',
		],
		[
			'name' => 'American Samoa',
			'iso'  => 'AS',
			'code' => '-683',
		],
		[
			'name' => 'Baker Island',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'Guam',
			'iso'  => 'GU',
			'code' => '-670',
		],
		[
			'name' => 'Howland Island',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'Jarvis Island',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'Johnston Atoll',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'Kingman Reef',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'Midway Islands',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'Navassa Island',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'Palmyra Atoll',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'U.S. Virgin Islands',
			'iso'  => 'VI',
			'code' => '-339',
		],
		[
			'name' => 'Wake Island',
			'iso'  => 'UM',
			'code' => '0',
		],
		[
			'name' => 'Hong Kong',
			'iso'  => 'HK',
			'code' => '852',
		],
		[
			'name' => 'Macau',
			'iso'  => 'MO',
			'code' => '853',
		],
		[
			'name' => 'Faroe Islands',
			'iso'  => 'FO',
			'code' => '298',
		],
		[
			'name' => 'Greenland',
			'iso'  => 'GL',
			'code' => '299',
		],
		[
			'name' => 'French Guiana',
			'iso'  => 'GF',
			'code' => '594',
		],
		[
			'name' => 'Guadeloupe',
			'iso'  => 'GP',
			'code' => '590',
		],
		[
			'name' => 'Martinique',
			'iso'  => 'MQ',
			'code' => '596',
		],
		[
			'name' => 'Reunion',
			'iso'  => 'RE',
			'code' => '262',
		],
		[
			'name' => 'Aland',
			'iso'  => 'AX',
			'code' => '340',
		],
		[
			'name' => 'Aruba',
			'iso'  => 'AW',
			'code' => '297',
		],
		[
			'name' => 'Svalbard',
			'iso'  => 'SJ',
			'code' => '47',
		],
		[
			'name' => 'Ascension',
			'iso'  => 'AC',
			'code' => '247',
		],
		[
			'name' => 'Tristan da Cunha',
			'iso'  => 'TA',
			'code' => '290',
		],
		[
			'name' => 'Australian Antarctic Territory',
			'iso'  => 'AQ',
			'code' => '0',
		],
		[
			'name' => 'Ross Dependency',
			'iso'  => 'AQ',
			'code' => '0',
		],
		[
			'name' => 'Peter I Island',
			'iso'  => 'AQ',
			'code' => '0',
		],
		[
			'name' => 'Queen Maud Land',
			'iso'  => 'AQ',
			'code' => '0',
		],
		[
			'name' => 'British Antarctic Territory',
			'iso'  => 'AQ',
			'code' => '0',
		],
		[
			'name' => 'Kosovo',
			'iso'  => 'XK',
			'code' => '383',
		],
		[
			'name' => 'Congo, (Congo ? Kinshasa)',
			'iso'  => 'CD',
			'code' => '243',
		],
		[
			'name' => 'Congo, (Congo ? Brazzaville)',
			'iso'  => 'CG',
			'code' => '242',
		],
		[
			'name' => 'Ashmore and Cartier Islands',
			'iso'  => 'AU',
			'code' => '0',
		],
		[
			'name' => 'Coral Sea Islands',
			'iso'  => 'AU',
			'code' => '0',
		],
		[
			'name' => 'British Sovereign Base Areas',
			'iso'  => 'II',
			'code' => '999',
		],
		[
			'name' => 'United States',
			'iso'  => 'US',
			'code' => '1',
		],
		[
			'name' => 'Croatia',
			'iso'  => 'HR',
			'code' => '385',
		],
	];

	public function get_template_data(): array {
		return [
			'title_block' => get_field( 'rgbc_authform_title_block', 'option' ),
			'full_name'   => get_field( 'rgbc_authform_full_name', 'option' ),
			'email'       => get_field( 'rgbc_authform_email', 'option' ),
			'phone'       => get_field( 'rgbc_authform_phone', 'option' ),
			'pass'        => get_field( 'rgbc_authform_pass', 'option' ),
			'terms'       => get_field( 'rgbc_authform_terms', 'option' ),
			'submit'      => get_field( 'rgbc_authform_submit', 'option' ),
			'message'     => get_field( 'rgbc_authform_message', 'option' ),
			'bottom_link' => get_field( 'rgbc_authform_link', 'option' ),
			'msgs'        => [
				'weak'   => __( 'Weak Password', 'rgbcode-authform' ),
				'medium' => __( 'Medium Password', 'rgbcode-authform' ),
				'strong' => __( 'Strong Password', 'rgbcode-authform' ),
			],
		];
	}

}
