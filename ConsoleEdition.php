<?php


    class user {
        public static array $usersDB = [];
        protected static int $idCounter = 0;
        protected int $id_user;
        protected string $username;
        protected string $email;
        protected string $password;
        
        protected DateTime $createdAt;
        protected DateTime $lastLogin;

        public function __construct($email, $username, $password)
        {
            self::$idCounter++;
            $this->id_user = self::$idCounter;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
            $this->createdAt = new DateTime();

            // $this->lastLogin = create function date set ti in of logout;

        }

        public function getId() { return $this->id_user; }
        public function getUsername() { return $this->username; }
        // login (string email, string password)
        public static function login ($email, $password)
        {
            foreach(self::$usersDB as $user)
            {
                if ($user->email === $email && $user->password == $password)
                    return $user;
            }
            return null;
        }
        // logout()
        // addcomment(int idArticle, string content)

    }

    class Moderateur extends user {

        // deleteAnyArticle(int id_article) return bool
        // updateAnyArticle(int id_article) return bool
    }

    
    class editor extends Moderateur {
        
        public function __construct($email, $username, $password)
        {
            parent::__construct($email, $username, $password);
        }
        // publishArticle(int id_article) 
        // moderateComment() return bool
        // createCategory() rerurn bool
        
    }
    
    class admin extends Moderateur{
        private bool $isSuperAdmin;

        public function __construct($email, $username, $password)
        {
            parent::__construct($email, $username, $password);
            $this->isSuperAdmin = 0;
        }

    }
    // createUser() return bool
    // updateUserRole(int userid, string newRole)
    // deleteUser(int userID) return bool
    // displayStatistique() return void

    class Author extends user {
        private string $bio;
        private array $articles = [];

        public function __construct($email, $username, $password)
        {
            parent::__construct( $email  ,$username, $password);

        }

        // createdArticle(string title, string content) return bool
        // updateOwnArticle(int id_Article) return bool
        // deleteOwnArticle(int id_Article) return bool
    }

    class Article {
        protected int $id_article;
        protected string $title;
        protected string $content;
        protected string $excerpt;
        protected string $status;
        protected int $id_author;
        protected DateTime $createdAt;
        protected DateTime $publishedAt;
        protected DateTime $updatedAt;

        public function __construct($title, $content, $excerpt, $status, $id_author)
        {
            $this->title = $title;
            $this->content = $content;
            $this->excerpt = $excerpt;
            $this->status = $status;
            $this->id_author = $id_author;
            $this->createdAt = new DateTime();
        }
    }

    class Comment {
        protected int $id_comment;
        protected string $content;
        protected int $id_article;
        protected DateTime $createdAt;

        public function  __construct($content, $id_article)
        {
            $this->content = $content;
            $this->id_article = $id_article;
            $this->createdAt = new DateTime();
        }
    }

    class Category {
        protected int $id_category;
        protected string $name_category;
        protected string $description;
        protected int $id_parentCategory;
        protected DateTime $createdAt;

        public function __construct($name_category, $description, $id_parentCategory = null)
        {
            $this->name_category = $name_category;
            $this->description = $description;
            $this->id_parentCategory = $id_parentCategory;
            $this->createdAt = new DateTime();
        }

        // addChild(Category child)
        // getArticles() return array
    }

$usersList = [
    new Admin(1, "admin1@test.com", "AdminOne", "1111"),
    new Admin(2, "admin2@test.com", "AdminTwo", "2222"),
    new Admin(3, "admin3@test.com", "AdminThree", "3333"),

    new Editor(4, "editor1@test.com", "EditorOne", "4444"),
    new Editor(5, "editor2@test.com", "EditorTwo", "5555"),
    new Editor(6, "editor3@test.com", "EditorThree", "6666"),

    new Author(7, "author1@test.com", "AuthorOne", "7777"),
    new Author(8, "author2@test.com", "AuthorTwo", "8888"),
    new Author(9, "author3@test.com", "AuthorThree", "9999"),
];


print_r($usersList[0]->getUsername());

    function displaymenuLogin()
    {
        // echo "\n=======================\n";
        // echo "\n  BLOG - Login page    \n";
        // echo "\n=======================\n";
        

        // echo "Entre Your Email\n";
        // echo "==> ";
        // $email = trim(fgets(STDIN, 100));
        // echo "Entre Your Password\n";
        // echo "==> ";
        // $password = trim(fgets(STDIN, 100));

        // $user = User::login($email,$password);
        // if ($user)
        // {
        //     echo "Connecté: " . $user->getUsername();
        // }
        // else
        //     echo "We don't have this Account";
    }

    displaymenuLogin();

?>
