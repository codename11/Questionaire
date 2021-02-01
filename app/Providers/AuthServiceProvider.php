<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        'App\Questionaire' => 'App\Policies\QuestionairePolicy',
        'App\Question' => 'App\Policies\QuestionPolicy',
        'App\Answer' => 'App\Policies\AnswerPolicy',
        'App\FieldType' => 'App\Policies\FieldTypePolicy',
        'App\PivotStatus' => 'App\Policies\PivotStatusPolicy',
        'App\PivotQuestionaire' => 'App\Policies\PivotQuestionairePolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\Model' => 'App\Policies\ModelPolicy',
        /*Questionaire::class => QuestionairePolicy::class,
        Question::class => QuestionPolicy::class,
        Answer::class => AnswerPolicy::class,
        FieldType::class => FieldTypePolicy::class,
        PivotStatus::class => PivotStatusPolicy::class,
        PivotQuestionaire::class => PivotQuestionairePolicy::class,
        Role::class => RolePolicy::class,*/
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
