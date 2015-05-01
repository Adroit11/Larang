<?php namespace App\Transformers;

class UserTransformer extends Transformer
{
	//This will transform a simgle object or lesson
	public function transform($lesson)
	{
		return [
			'title' => $lesson['title'],
			'body'	=> $lesson['body'],
			'active' => (boolean) $lesson['some_bool']
		];
	}
}