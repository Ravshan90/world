<?php

namespace app\services;

use yii\data\SqlDataProvider;

class AppService
{
	public static function getRegionsData()
	{
		$sql = "SELECT Continent, Region, COUNT(Name) AS COUNTRIES, AVG(LifeExpectancy) AS LifeDuration, SUM(Population) AS POPULATION, SUM(countrycities) as cities, SUM(countrylanguages) as languages FROM Country 
				LEFT JOIN (Select CountryCode, count(CountryCode) as countrycities from CITY group by CountryCode) country_cities ON Code = country_cities.CountryCode 
				LEFT JOIN (Select CountryCode, count(CountryCode) as countrylanguages from CountryLanguage group by CountryCode) country_languages ON Code = country_languages.CountryCode 
				GROUP BY Region";
				
		$sqlCount = "SELECT  COUNT(*) FROM Country 
				LEFT JOIN (Select CountryCode, count(CountryCode) as countrycities from CITY group by CountryCode) country_cities ON Code = country_cities.CountryCode 
				LEFT JOIN (Select CountryCode, count(CountryCode) as countrylanguages from CountryLanguage group by CountryCode) country_languages ON Code = country_languages.CountryCode 
				GROUP BY Region";
		
		
		
		$count = \Yii::$app->db->createCommand($sqlCount)->queryScalar();

		$provider = new SqlDataProvider([
					'sql' => $sql,
					'totalCount' => $count,
					'pagination' => [
						'pageSize' => 30,
					],
					'sort' => [
						'attributes' => [
							'Continent',
							'Region',
							'COUNTRIES',
							'LifeDuration',
							'POPULATION',
							'cities',
							'languages'
						]
					]
				]);
		
		
		return $provider;
	}	
}