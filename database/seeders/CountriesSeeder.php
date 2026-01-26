<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name_en' => 'Jordan', 'name_ar' => 'الأردن', 'code' => 'JOR', 'flag_code' => 'jo', 'currency_code' => 'JOD', 'currency_name_en' => 'Jordanian Dinar', 'currency_name_ar' => 'دينار أردني', 'interest_rate' => 6.5],
            ['name_en' => 'United Arab Emirates', 'name_ar' => 'الإمارات العربية المتحدة', 'code' => 'ARE', 'flag_code' => 'ae', 'currency_code' => 'AED', 'currency_name_en' => 'UAE Dirham', 'currency_name_ar' => 'درهم إماراتي', 'interest_rate' => 4.0],
            ['name_en' => 'Saudi Arabia', 'name_ar' => 'المملكة العربية السعودية', 'code' => 'SAU', 'flag_code' => 'sa', 'currency_code' => 'SAR', 'currency_name_en' => 'Saudi Riyal', 'currency_name_ar' => 'ريال سعودي', 'interest_rate' => 4.5],
            ['name_en' => 'Egypt', 'name_ar' => 'مصر', 'code' => 'EGY', 'flag_code' => 'eg', 'currency_code' => 'EGP', 'currency_name_en' => 'Egyptian Pound', 'currency_name_ar' => 'جنيه مصري', 'interest_rate' => 18.0],
            ['name_en' => 'Lebanon', 'name_ar' => 'لبنان', 'code' => 'LBN', 'flag_code' => 'lb', 'currency_code' => 'LBP', 'currency_name_en' => 'Lebanese Pound', 'currency_name_ar' => 'ليرة لبنانية', 'interest_rate' => 20.0],
            ['name_en' => 'Kuwait', 'name_ar' => 'الكويت', 'code' => 'KWT', 'flag_code' => 'kw', 'currency_code' => 'KWD', 'currency_name_en' => 'Kuwaiti Dinar', 'currency_name_ar' => 'دينار كويتي', 'interest_rate' => 3.5],
            ['name_en' => 'Qatar', 'name_ar' => 'قطر', 'code' => 'QAT', 'flag_code' => 'qa', 'currency_code' => 'QAR', 'currency_name_en' => 'Qatari Riyal', 'currency_name_ar' => 'ريال قطري', 'interest_rate' => 3.5],
            ['name_en' => 'Bahrain', 'name_ar' => 'البحرين', 'code' => 'BHR', 'flag_code' => 'bh', 'currency_code' => 'BHD', 'currency_name_en' => 'Bahraini Dinar', 'currency_name_ar' => 'دينار بحريني', 'interest_rate' => 4.0],
            ['name_en' => 'Oman', 'name_ar' => 'عمان', 'code' => 'OMN', 'flag_code' => 'om', 'currency_code' => 'OMR', 'currency_name_en' => 'Omani Rial', 'currency_name_ar' => 'ريال عماني', 'interest_rate' => 4.5],
            ['name_en' => 'Iraq', 'name_ar' => 'العراق', 'code' => 'IRQ', 'flag_code' => 'iq', 'currency_code' => 'IQD', 'currency_name_en' => 'Iraqi Dinar', 'currency_name_ar' => 'دينار عراقي', 'interest_rate' => 12.0],
            ['name_en' => 'Syria', 'name_ar' => 'سوريا', 'code' => 'SYR', 'flag_code' => 'sy', 'currency_code' => 'SYP', 'currency_name_en' => 'Syrian Pound', 'currency_name_ar' => 'ليرة سورية', 'interest_rate' => 20.0],
            ['name_en' => 'Palestine', 'name_ar' => 'فلسطين', 'code' => 'PSE', 'flag_code' => 'ps', 'currency_code' => 'ILS', 'currency_name_en' => 'Israeli Shekel', 'currency_name_ar' => 'شيكل', 'interest_rate' => 7.0],
            ['name_en' => 'Yemen', 'name_ar' => 'اليمن', 'code' => 'YEM', 'flag_code' => 'ye', 'currency_code' => 'YER', 'currency_name_en' => 'Yemeni Rial', 'currency_name_ar' => 'ريال يمني', 'interest_rate' => 18.0],
            ['name_en' => 'Algeria', 'name_ar' => 'الجزائر', 'code' => 'DZA', 'flag_code' => 'dz', 'currency_code' => 'DZD', 'currency_name_en' => 'Algerian Dinar', 'currency_name_ar' => 'دينار جزائري', 'interest_rate' => 10.0],
            ['name_en' => 'Morocco', 'name_ar' => 'المغرب', 'code' => 'MAR', 'flag_code' => 'ma', 'currency_code' => 'MAD', 'currency_name_en' => 'Moroccan Dirham', 'currency_name_ar' => 'درهم مغربي', 'interest_rate' => 8.0],
            ['name_en' => 'Tunisia', 'name_ar' => 'تونس', 'code' => 'TUN', 'flag_code' => 'tn', 'currency_code' => 'TND', 'currency_name_en' => 'Tunisian Dinar', 'currency_name_ar' => 'دينار تونسي', 'interest_rate' => 9.0],
            ['name_en' => 'Libya', 'name_ar' => 'ليبيا', 'code' => 'LBY', 'flag_code' => 'ly', 'currency_code' => 'LYD', 'currency_name_en' => 'Libyan Dinar', 'currency_name_ar' => 'دينار ليبي', 'interest_rate' => 12.0],
            ['name_en' => 'Sudan', 'name_ar' => 'السودان', 'code' => 'SDN', 'flag_code' => 'sd', 'currency_code' => 'SDG', 'currency_name_en' => 'Sudanese Pound', 'currency_name_ar' => 'جنيه سوداني', 'interest_rate' => 30.0],
            ['name_en' => 'Turkey', 'name_ar' => 'تركيا', 'code' => 'TUR', 'flag_code' => 'tr', 'currency_code' => 'TRY', 'currency_name_en' => 'Turkish Lira', 'currency_name_ar' => 'ليرة تركية', 'interest_rate' => 35.0],
            ['name_en' => 'Iran', 'name_ar' => 'إيران', 'code' => 'IRN', 'flag_code' => 'ir', 'currency_code' => 'IRR', 'currency_name_en' => 'Iranian Rial', 'currency_name_ar' => 'ريال إيراني', 'interest_rate' => 25.0],
            ['name_en' => 'Pakistan', 'name_ar' => 'باكستان', 'code' => 'PAK', 'flag_code' => 'pk', 'currency_code' => 'PKR', 'currency_name_en' => 'Pakistani Rupee', 'currency_name_ar' => 'روبية باكستانية', 'interest_rate' => 20.0],
            ['name_en' => 'India', 'name_ar' => 'الهند', 'code' => 'IND', 'flag_code' => 'in', 'currency_code' => 'INR', 'currency_name_en' => 'Indian Rupee', 'currency_name_ar' => 'روبية هندية', 'interest_rate' => 8.0],
            ['name_en' => 'United States', 'name_ar' => 'الولايات المتحدة', 'code' => 'USA', 'flag_code' => 'us', 'currency_code' => 'USD', 'currency_name_en' => 'US Dollar', 'currency_name_ar' => 'دولار أمريكي', 'interest_rate' => 6.0],
            ['name_en' => 'United Kingdom', 'name_ar' => 'المملكة المتحدة', 'code' => 'GBR', 'flag_code' => 'gb', 'currency_code' => 'GBP', 'currency_name_en' => 'British Pound', 'currency_name_ar' => 'جنيه إسترليني', 'interest_rate' => 5.5],
            ['name_en' => 'Germany', 'name_ar' => 'ألمانيا', 'code' => 'DEU', 'flag_code' => 'de', 'currency_code' => 'EUR', 'currency_name_en' => 'Euro', 'currency_name_ar' => 'يورو', 'interest_rate' => 4.0],
            ['name_en' => 'France', 'name_ar' => 'فرنسا', 'code' => 'FRA', 'flag_code' => 'fr', 'currency_code' => 'EUR', 'currency_name_en' => 'Euro', 'currency_name_ar' => 'يورو', 'interest_rate' => 5.0],
            ['name_en' => 'Italy', 'name_ar' => 'إيطاليا', 'code' => 'ITA', 'flag_code' => 'it', 'currency_code' => 'EUR', 'currency_name_en' => 'Euro', 'currency_name_ar' => 'يورو', 'interest_rate' => 5.0],
            ['name_en' => 'Spain', 'name_ar' => 'إسبانيا', 'code' => 'ESP', 'flag_code' => 'es', 'currency_code' => 'EUR', 'currency_name_en' => 'Euro', 'currency_name_ar' => 'يورو', 'interest_rate' => 5.0],
            ['name_en' => 'Canada', 'name_ar' => 'كندا', 'code' => 'CAN', 'flag_code' => 'ca', 'currency_code' => 'CAD', 'currency_name_en' => 'Canadian Dollar', 'currency_name_ar' => 'دولار كندي', 'interest_rate' => 5.0],
            ['name_en' => 'Australia', 'name_ar' => 'أستراليا', 'code' => 'AUS', 'flag_code' => 'au', 'currency_code' => 'AUD', 'currency_name_en' => 'Australian Dollar', 'currency_name_ar' => 'دولار أسترالي', 'interest_rate' => 5.0],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                $country
            );
        }
    }
}
