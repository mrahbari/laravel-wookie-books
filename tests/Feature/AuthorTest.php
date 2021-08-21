<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 18:35 PM
 */
namespace Tests\Feature;

use \App\Models\Author;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    protected $authorId;
    protected $modifiedFirstName;
    protected $modifiedLastName;

    /**
     * Initial setup
     */
    public function setUp(): void
    {
        $this->authorId = 1;
        $this->modifiedFirstName = 'Jeremy';
        $this->modifiedLastName = 'Ania';

        parent::setup();
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNewAuthor()
    {
        $author = Author::find($this->authorId);
        $author->first_name = $this->modifiedFirstName . '_' . Str::random(2);
        $author->last_name = $this->modifiedLastName;
        $author->create();

        $this->assertIsInt($author->id);
        $this->assertEquals($author->last_name, $this->modifiedLastName);
    }

    /**
     * Test to find author
     */
    public function testFindAuthor()
    {
        //DB::connection()->enableQueryLog();
        $author = Author::find($this->authorId);
        //$queries = DB::getQueryLog();
        //dd($queries);
        $this->assertEquals($author->id, $this->authorId);
    }


    /**
     * Test for editing Authors
     */
    public function testEditAuthor()
    {
        $author = Author::find($this->authorId);
        $author->first_name = $this->modifiedFirstName;
        $author->last_name = $this->modifiedLastName;
        $author->save();

        $this->assertEquals($author->first_name, $this->modifiedFirstName);
        $this->assertEquals($author->last_name, $this->modifiedLastName);
    }

    /**
     * A basic test for delete a record.
     *
     * @return void
     */
    public function testDeleteAuthor()
    {
        //First and recommended solution
        $author = Author::latest('created_at')->first();
        $hashedId = hashids_encode($author->id);
        $url = '/api/v1/authors/' . $hashedId;
        $response = $this->delete($url);
        $response->assertStatus(202);

        //Second solution
        /*$author = Author::latest('created_at')->first();;
        $response = $author->delete();
        $this->assertEquals(true, (bool)$response);*/
        //dump($response);
    }
}
