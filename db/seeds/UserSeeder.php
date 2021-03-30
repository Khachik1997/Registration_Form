<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
		$faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'username'      => $faker->userName,
                'password'      => sha1($faker->password),
                'password_salt' => sha1('foo'),
                'email'         => $faker->email,
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'created'       => date('Y-m-d H:i:s'),
            ];
        }

        $this->table('users')->insert($data)->save();
    }
    }
}
