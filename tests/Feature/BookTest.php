<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 18:45 PM
 */
namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookTest extends TestCase
{
    protected $bookId;
    protected $modifiedTitle;
    protected $modifiedDescription;

    /**
     * Initial setup
     */
    public function setUp(): void
    {
        $this->bookId = 1;
        $this->modifiedTitle = 'Book Title';
        $this->modifiedDescription = 'This is a sample comment for book description';

        parent::setup();
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNewBook()
    {
        $book = Book::find($this->bookId);
        $book->title = $this->modifiedTitle . '_' . Str::random(2);
        $book->last_name = $this->modifiedDescription;
        $book->create();

        $this->assertIsInt($book->id);
        $this->assertEquals($book->last_name, $this->modifiedDescription);
    }

    /**
     * Test to find author
     */
    public function testFindBook()
    {
        //DB::connection()->enableQueryLog();
        $book = Book::find($this->bookId);
        //$queries = DB::getQueryLog();
        //dd($queries);
        $this->assertEquals($book->id, $this->bookId);
    }


    /**
     * Test for editing Books
     */
    public function testEditBook()
    {
        $book = Book::find($this->bookId);
        $book->title = $this->modifiedTitle;
        $book->description = $this->modifiedDescription;
        $book->save();

        $this->assertEquals($book->title, $this->modifiedTitle);
        $this->assertEquals($book->description, $this->modifiedDescription);
    }

    /**
     * A basic test for delete a record.
     *
     * @return void
     */
    public function testDeleteBook()
    {
        //First and recommended solution
        $book = Book::latest('created_at')->first();
        $hashedId = hashids_encode($book->id);
        $url = '/api/v1/books/' . $hashedId;
        $response = $this->delete($url);
        $response->assertStatus(202);
    }

    /**
     * A basic test for unPublish a record.
     *
     * @return void
     */
    public function testUnPublishBook()
    {
        //First and recommended solution
        $book = Book::latest('created_at')->first();
        $hashedId = hashids_encode($book->id);
        $url = '/api/v1/books/un-publish/' . $hashedId;
        $response = $this->delete($url);
        $response->assertStatus(202);

    }
}
