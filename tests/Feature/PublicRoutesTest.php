<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\NewsEvent;

class PublicRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_about_page_returns_a_successful_response(): void
    {
        $response = $this->get('/about-us');
        $response->assertStatus(200);
    }

    public function test_team_page_returns_a_successful_response(): void
    {
        $response = $this->get('/teams');
        $response->assertStatus(200);
    }

    public function test_projects_page_returns_a_successful_response(): void
    {
        $response = $this->get('/projects');
        $response->assertStatus(200);
    }

    public function test_gallery_page_returns_a_successful_response(): void
    {
        $response = $this->get('/gallery');
        $response->assertStatus(200);
    }

    public function test_news_page_returns_a_successful_response(): void
    {
        $response = $this->get('/news-and-events');
        $response->assertStatus(200);
    }

    public function test_downloads_page_returns_a_successful_response(): void
    {
        $response = $this->get('/downloads/publications');
        $response->assertStatus(200);
    }

    public function test_contact_page_returns_a_successful_response(): void
    {
        $response = $this->get('/contact-us');
        $response->assertStatus(200);
    }

    public function test_project_show_page_loads_correctly(): void
    {
        $project = Project::create([
            'title' => 'Test Project',
            'slug' => 'test-project',
            'content' => 'Content',
            'is_active' => true,
        ]);

        $response = $this->get("/projects/{$project->slug}");
        $response->assertStatus(200);
        $response->assertSee('Test Project');
    }

    public function test_news_show_page_loads_correctly(): void
    {
        $news = NewsEvent::create([
            'title' => 'Test News',
            'slug' => 'test-news',
            'content' => 'Content',
            'type' => 'news',
            'is_published' => true,
        ]);

        $response = $this->get("/news-and-events/{$news->slug}");
        $response->assertStatus(200);
        $response->assertSee('Test News');
    }
}
