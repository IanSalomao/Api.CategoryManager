<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTreggerAfterUserInsert extends Migration
{
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER after_user_insert
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                -- Inserindo uma categoria personalizada com o nome do usuário
                INSERT INTO categorys (name, description, id_user, created_at, updated_at)
                VALUES (
                    CONCAT("Olá ", NEW.name, "! É um prazer ter você no Manage Categorys."),
                    "Tenha total liberdade para organizar suas Categorias e Subcategorias a qualquer momento.",
                    NEW.id_user,
                    NOW(),
                    NOW()
                );

                -- Usando LAST_INSERT_ID() para pegar o id da categoria recém-criada
                INSERT INTO subcategorys (name, description, id_category, created_at, updated_at)
                VALUES
                    ("Crie", "Adicione descrições nas suas subcategorias.", LAST_INSERT_ID(), NOW(), NOW()),
                    ("suas", "", LAST_INSERT_ID(), NOW(), NOW()),
                    ("sub", "", LAST_INSERT_ID(), NOW(), NOW()),
                    ("categorias", "", LAST_INSERT_ID(), NOW(), NOW()),
                    ("agora", "", LAST_INSERT_ID(), NOW(), NOW()),
                    ("mesmo!", "", LAST_INSERT_ID(), NOW(), NOW());
            END;
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_user_insert');
    }
}
