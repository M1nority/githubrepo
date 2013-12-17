<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class TestModel extends CActiveRecord
{

	public $input;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'testtable';
	}

	public function rules()
	{
		return array(
			// username and password are required
			array('input', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'input' => 'Test data',
		);
	}

}
