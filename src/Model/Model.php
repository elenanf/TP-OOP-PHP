<?php
class Model
{

    private $db;

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'movies_oop';
        $user = 'root';
        $pwd = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
            $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }

    }

    public function addNewUser($pseudo, $email, $pswrd)
    {
        try {
            $request = $this->db->prepare('INSERT INTO users (user_password, user_email, user_pseudo) VALUES (?, ?, ?)');
            $request->execute([
                $pswrd,
                $email,
                $pseudo
            ]);

            return $this->db->lastInsertId();

        } catch (Exception $e) {

            var_dump($e->getMessage());

            return false;
        }

    }

    public function getOneUser($email) {

        try {
            $request = $this->db->prepare('SELECT * FROM users 
                                                LEFT JOIN roles ON users.id_role = roles.role_id 
                                                WHERE user_email = ?');
            $request->execute([$email]);

            return $request->fetch();

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return null;
        }


    }

    public function getAllCategories() {

        try {
            $request = $this->db->prepare('SELECT * FROM categories');
            $request->execute([]);

            return $request->fetchAll();

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return null;
        }
    }

    public function getAllActors() {

        try {
            return $this->db->query('SELECT * FROM actors');

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return null;
        }
    }

    public function getAllDirectors() {

        try {
            return $this->db->query('SELECT * FROM directors');

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return null;
        }
    }

    public function addNewMovie($title, $year, $synopsis, $time, $picture, $idCategory, $idDirector, $idUser, $trailer)
    {
        try {
            $request = $this->db->prepare("INSERT INTO movies (movie_name, movie_release_year, movie_synopsis, movie_duration, movie_image, movie_trailer, id_category, id_director, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $request->execute([
                $title,
                $year,
                $synopsis,
                $time,
                $picture,
                $trailer,
                $idCategory,
                $idDirector,
                $idUser
            ]);

            return $this->db->lastInsertId();

        } catch (Exception $e) {

            var_dump($e->getMessage());
        }
    }

    public function addActorsForMovie($actorsList, $idMovie) {

        try {
            $sql = 'INSERT INTO movies_actors (id_actor, id_movie) VALUES ';
            $data = [];

            for ($i = 0; $i < count($actorsList); $i++) {
                $sql  .= '(?, ?)';

                if ($i < count($actorsList) - 1) {
                    $sql .= ',';
                }

                $data[] = $actorsList[$i];
                $data[] = $idMovie;
            }

            $request = $this->db->prepare($sql);
            $request->execute($data);
            return true;
        } catch (Exception $e) {
            var_dump($e->getMessage());

            return false;
        }
    }

    public function getAllMovies($idUser) {
        try {
            $request = $this->db->prepare('
                                                    SELECT movie_id, movie_image, movie_name 
                                                    FROM movies 
                                                    WHERE id_user = ?');
            $request->execute([$idUser]);

            return $request->fetchAll();

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return null;
        }
    }

    public function getMovie($id) {
        try {
            $request = $this->db->prepare('
                                                    SELECT * 
                                                    FROM movies
                                                    LEFT JOIN directors ON movies.id_director = directors.director_id
                                                    LEFT JOIN categories ON movies.id_category = categories.category_id
                                                    WHERE movie_id = ?
                                                    ');
            $request->execute([$id]);

            return $request->fetch();

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return null;
        }
    }

    public function getActorsByMovie($id) {
        try {
            $request = $this->db->prepare('
                                                    SELECT actors.actor_name 
                                                    FROM movies_actors
                                                    LEFT JOIN actors ON movies_actors.id_actor = actors.actor_id
                                                    WHERE movies_actors.id_movie = ?
                                                    ');
            $request->execute([$id]);

            return $request->fetchAll();

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return null;
        }
    }

    public function deleteMovie($id) {
        try {
            $request = $this->db->prepare('
                                                    DELETE FROM movies
                                                    WHERE movie_id = ?
                                                    ');
            $request->execute([$id]);

            return true;

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return false;
        }
    }

    public function deleteMoviesActors($id) {
        try {
            $request = $this->db->prepare('
                                                    DELETE FROM movies_actors
                                                    WHERE id_movie = ?
                                                    ');
            $request->execute([$id]);

            return true;

        } catch (Exception $e) {

            var_dump('Erreur : ' . $e->getMessage());

            return false;
        }
    }

}