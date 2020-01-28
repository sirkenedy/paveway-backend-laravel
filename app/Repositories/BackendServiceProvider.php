<?php

namespace App\repositories;

use App\Repositories\Eloquent\User\UserRepositoryInterface;
use App\Repositories\Eloquent\User\UserRepository;
use App\Repositories\Eloquent\Book\BookRepositoryInterface;
use App\Repositories\Eloquent\Book\BookRepository;
use App\Repositories\Eloquent\Faculty\FacultyRepositoryInterface;
use App\Repositories\Eloquent\Faculty\FacultyRepository;
use App\Repositories\Eloquent\Department\DepartmentRepositoryInterface;
use App\Repositories\Eloquent\Department\DepartmentRepository;
use App\Repositories\Eloquent\Program\ProgramRepositoryInterface;
use App\Repositories\Eloquent\Program\ProgramRepository;
use App\Repositories\Eloquent\Level\LevelRepositoryInterface;
use App\Repositories\Eloquent\Level\LevelRepository;
use App\Repositories\Eloquent\Course\CourseRepositoryInterface;
use App\Repositories\Eloquent\Course\CourseRepository;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );
        $this->app->bind(
            FacultyRepositoryInterface::class,
            FacultyRepository::class
        );
        $this->app->bind(
            DepartmentRepositoryInterface::class,
            DepartmentRepository::class
        );
        $this->app->bind(
            ProgramRepositoryInterface::class,
            ProgramRepository::class
        );
        $this->app->bind(
            LevelRepositoryInterface::class,
            LevelRepository::class
        );
        $this->app->bind(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}