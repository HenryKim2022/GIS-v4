Mengkonfigurasi, Menggunakan PHP artisan Migrate & Seeder (set default record into table) :
1. Buat model migration nya.
	Jalankan code berikut
		ex:
			php artisan make:migration <create_nama_table_yg_akan_dimigrasi_1>
			php artisan make:migration <create_nama_table_yg_akan_dimigrasi_2>
		what we do:
			php artisan make:migration create_tb_mark
			php artisan make:migration create_tb_category
			php artisan make:migration create_tb_institution
			php artisan make:migration create_tb_users
		
	Note:
		* Kita bisa membuat >1 file migration, atau menyatukan file nya.
	

	
	
	
2. Isikan content file migrate nya.
	*Content of create_tb_mark:
		<?php
			use Illuminate\Database\Migrations\Migration;
			use Illuminate\Database\Schema\Blueprint;
			use Illuminate\Support\Facades\Schema;

			return new class extends Migration
			{
				/**
				 * Run the migrations.
				 */
				public function up(): void
				{
					Schema::create('tb_mark', function (Blueprint $table) {
						$table->id('mark_id'); // Set 'mark_id' as primary key
						$table->string('mark_lat', 20);
						$table->string('mark_lon', 20);
						$table->timestamps();
						$table->softDeletes();
					});
				}

				/**
				 * Reverse the migrations.
				 */
				public function down(): void
				{
					Schema::dropIfExists('tb_mark');
				}
			};
		?>
		
	*Content of create_tb_category:
		<?php
			use Illuminate\Database\Migrations\Migration;
			use Illuminate\Database\Schema\Blueprint;
			use Illuminate\Support\Facades\Schema;

			return new class extends Migration
			{
				/**
				 * Run the migrations.
				 */
				public function up(): void
				{
					Schema::create('tb_category', function (Blueprint $table) {
						$table->id('cat_id');
						$table->string('cat_name', 45);
						$table->timestamps();
						$table->softDeletes();
					});
				}

				/**
				 * Reverse the migrations.
				 */
				public function down(): void
				{
					Schema::dropIfExists('tb_category');
				}
			};
		?>
		
	*Content of create_tb_institution:
		<?php
			use Illuminate\Database\Migrations\Migration;
			use Illuminate\Database\Schema\Blueprint;
			use Illuminate\Support\Facades\Schema;

			return new class extends Migration
			{
				/**
				 * Run the migrations.
				 */
				public function up(): void
				{
					Schema::create('tb_institution', function (Blueprint $table) {
						$table->id('institu_id');
						$table->string('institu_name', 45);
						$table->string('institu_npsn', 20);
						$table->string('institu_logo', 254);
						$table->string('institu_address', 254);
						$table->string('institu_image', 254);
						$table->foreignId('mark_id')->constrained('tb_mark', 'mark_id'); // Specify 'mark_id' as the foreign key column
						$table->foreignId('cat_id')->constrained('tb_category', 'cat_id');
						$table->timestamps();
						$table->softDeletes();
					});
				}

				/**
				 * Reverse the migrations.
				 */
				public function down(): void
				{
					Schema::table('tb_institution', function (Blueprint $table) {
						$table->dropForeign(['mark_id']);
						$table->dropForeign(['cat_id']);
					});

					Schema::dropIfExists('tb_mark');
					Schema::dropIfExists('tb_category');
					Schema::dropIfExists('tb_institution');
				}
			};

		?>
						
		
	Content of create_tb_users:
		<?php
			use Illuminate\Database\Migrations\Migration;
			use Illuminate\Database\Schema\Blueprint;
			use Illuminate\Support\Facades\Schema;

			return new class extends Migration
			{
				/**
				 * Run the migrations.
				 */
				public function up(): void
				{
					Schema::create('tb_users', function (Blueprint $table) {
						$table->id();
						$table->timestamps();
						$table->softDeletes();
					});
				}

				/**
				 * Reverse the migrations.
				 */
				public function down(): void
				{
					Schema::dropIfExists('tb_users');
				}
			};
		?>
	
		
	Note:
		* Semua migration yg dibuat akan dijalankan otomatis 
		berdasrkan tgl file migrations, ketika menjalankan code berikut:
			php artisan migrate
	
	
		
		
		
		

3. Melakukan rollback migrasi(menghapus table).
	Periksa migrasi yg telah dijalankan dg code2 ini...
		* Cek status:
			php artisan migrate:status
	
		* Hanya Rollback 1 step dari yg bertanda step1:
			php artisan migrate:rollback --step=1
		
		* Rollback semua step (kec, table migration):
			php artisan migrate:rollback
		
	Note:
		Pastikan untuk mengganti --step=1 dengan angka yang sesuai jika ingin melakukan rollback lebih dari satu migrasi.
		
		
		
		
		
		
		
		
4. Buat model seeder nya.
	Jalankan code berikut untuk membuat model:
		php artisan make:model Setup_Default_Users
		
	Ubah content nya sbb:
		<?php

			namespace App\Models;

			use Illuminate\Database\Eloquent\Factories\HasFactory;
			use Illuminate\Database\Eloquent\Model;

			use Illuminate\Database\Eloquent\SoftDeletes;

			class Setup_Default_Users extends Model
			{
				use HasFactory;

				use SoftDeletes;

				protected $table = 'tb_users';
				protected $primaryKey = 'user_id';
				protected $fillable = ['user_name', 'user_password', 'user_image'];
				protected $dates = ['deleted_at'];

			}
		?>


5. Buat seeder nya:
	Jalankan code berikut untuk membuat seeder:
		php artisan make:seeder Setup_Default_Users_Seeder
	
	Tambahkan content nya:
		<?php
			namespace Database\Seeders;

			use Illuminate\Database\Console\Seeds\WithoutModelEvents;
			use Illuminate\Database\Seeder;

			use App\Models\Setup_Default_Users;

			class Setup_Default_Users_Seeder extends Seeder
			{
				/**
				 * Run the database seeds.
				 */
				public function run(): void
				{
					Setup_Default_Users::create([
						'user_name' => 'Admin',
						'user_password' => bcrypt('123456'),
						'user_image' => '',
					]);
				}
			}
		?>
			
	

6. Setelah menambahkan data ke seeder, perlu membuat pemanggil seeder dari dalam file DatabaseSeeder.php. 
	* Buka file DatabaseSeeder.php yang ada di direktori database/seeds, dan tambahkan pemanggilan seeder 
	Berikut ke dalam method run(). Contohnya:
		<?php
			namespace Database\Seeders;

			// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
			use Illuminate\Database\Seeder;			//<------ Yg ini penting

			class DatabaseSeeder extends Seeder
			{
				/**
				 * Seed the application's database.
				 */
				public function run(): void
				{
					$this->call(Setup_Default_Users_Seeder::class);		// <----- Yg ini penting
				}
			}
		?>
		
7. Jalankan perintah untuk melakukan import seeder:
	php artisan db:seed
