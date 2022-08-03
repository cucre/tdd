<?php

namespace Tests\Feature\MyTDD;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function list_of_posts_can_be_retrieved() 
    {
        $this->withoutExceptionHandling();

        Post::factory()->count(3)->create(); //datos de prueba

        $response = $this->get(route('posts.index'));

        $response->assertOk();

        $posts = Post::all();

        $response->assertViewIs('posts.index');
        $response->assertViewHas('posts', $posts);
    }

    /** @test */
    public function a_post_can_be_retrived() 
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post->id));

        $response->assertOk();

        $post_first = Post::first();

        $response->assertViewIs('posts.show');
        $response->assertViewHas('post', $post_first);
    }

    /** @test */
    public function a_post_can_be_created()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);
        
        $data = [
            'title' => $this->faker->text(),
            'content' => $this->faker->paragraph(),
        ];
        $response = $this->post(route('posts.store'), [
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        $this->assertCount(1, Post::all());
        
        $post = Post::first();
        $this->assertEquals($post->title, "Hola");
        $this->assertEquals($post->content, $data['content']);

        $response->assertRedirect(route('posts.show', $post->id));
    }

    /** @test */
    public function a_post_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);
        
        $post = Post::factory()->create();
        $data = [
            'title' => $this->faker->text(),
            'content' => $this->faker->paragraph(),
        ];
        
        $response = $this->put(route('posts.update', $post->id), [
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        $this->assertCount(1, Post::all());
        
        $post_fresh = $post->fresh();
        $this->assertEquals($post_fresh->title, $data['title']);
        $this->assertEquals($post_fresh->content, $data['content']);

        $response->assertRedirect(route('posts.show', $post_fresh->id));
    }

    /** @test */
    public function a_post_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);
        
        $post = Post::factory()->create();
        
        $response = $this->delete(route('posts.destroy', $post->id));

        $this->assertCount(0, Post::all());

        $response->assertRedirect(route('posts.index'));
    }

    /** @test */
    public function post_title_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $data = [
            'title' => '',
            'content' => $this->faker->paragraph(),
        ];
        $response = $this->post(route('posts.store'), [
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function post_content_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $data = [
            'title' => $this->faker->text(),
            'content' => '',
        ];
        $response = $this->post(route('posts.store'), [
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        $response->assertSessionHasErrors(['content']);
    }
}
