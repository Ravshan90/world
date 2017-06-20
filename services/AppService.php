<?php

namespace app\services;

use yii\data\SqlDataProvider;

class AppService
{
	/*
		Returns data of regions
	*/
	public static function getRegionsData()
	{
		$sql = "SELECT Continent, Region, COUNT(Name) AS Countries, AVG(LifeExpectancy) AS LifeDuration, SUM(Population) AS Population, SUM(countrycities) as Cities, SUM(countrylanguages) as Languages FROM Country 
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
							'Countries',
							'LifeDuration',
							'Population',
							'Cities',
							'Languages'
						]
					]
				]);
		
		
		return $provider;
	}	
}