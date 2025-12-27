<?php


    class user {
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
        }

        public function getId() { return $this->id_user; }
        public function getUsername() { return $this->username; }
        public function getemail() { return $this->email; }
        public function getpassword() { return $this->password; }
        public function GetDateCreation() { return $this->createdAt->format('Y-m-d H:i:s');}

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
        public function ArticleStatus(array $allArticles) 
        {
            $foundDraft = false;

            echo "\n--- List of Articles Draft ---\n";

            foreach($allArticles as $index => $art) 
            {
                if ($art->getStatus() == 'Draft') 
                {
                    $foundDraft = true;
                    echo "[" . $index . "] " . $art->getTitle() . "\n";
                }
            }

            if (!$foundDraft) {
                echo "\n0 Article , All articles are Published\n";
            } 
            else {
                echo "\nEntrer l'index de l'article w valider (ou -1 pour cancel): ";
                $idx = (int)trim(fgets(STDIN));

                if (isset($allArticles[$idx]))
                {
                    if ($allArticles[$idx]->getStatus() == 'Draft') {
                        $allArticles[$idx]->setStatus("Publish"); 
                        echo "Article Publie\n";
                    } else {
                        echo "this article was publier.\n";
                    }
                } 
                else if ($idx != -1) {
                    echo "Index Incorrect.\n";
                }
            }
        }
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
        
        // createUser() return bool
        public function CreateUser($role)
        {
            echo "Entre Email Adrese: ";
            $newEmail = trim(fgets(STDIN));
            echo "Entre User name: ";
            $NewUserName = trim(fgets(STDIN));
            echo "Entre Password: ";
            $NewPassword = trim(fgets(STDIN));
            if ($role === "Admin")
                $NewUser = new Admin($newEmail, $NewUserName, $NewPassword);
            else if ($role == "editor")
                $NewUser = new editor($newEmail, $NewUserName, $NewPassword);
            else
                $NewUser = new Author($newEmail, $NewUserName, $NewPassword);
            
          
                return $NewUser;
        }
        // deleteUser(int userID) return bool
        public function deleteUser($AllUsersData)
        {
            foreach ($AllUsersData as $index => $UserData)
            {
                echo "n°[$index] => " . $UserData->getUsername() . "\n";
            }
            echo "Entre n° of User To delete: ";
            $indexUserDelete = (int)trim(fgets(STDIN));
            unset($AllUsersData[$indexUserDelete]);
            return $AllUsersData;
        }
        // updateUserRole(int userid, string newRole)
        // displayStatistique() return void
    }

    class Author extends user {
        protected string $bio;
        protected array $articles = [];

        public function __construct($email, $username, $password)
        {
            parent::__construct( $email  ,$username, $password);
        }

        
        // createdArticle(string title, string content) return bool
        public function addArticle(Article $article)
        {
            $this->articles[] = $article;
        }

        public function getArticles()
        {
            return $this->articles;
        }



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
        protected array $Comments = [];

        public function __construct($title, $content, $excerpt, $status, $id_author)
        {
            $this->title = $title;
            $this->content = $content;
            $this->excerpt = $excerpt;
            $this->status = $status;
            $this->id_author = $id_author;
            $this->createdAt = new DateTime();
        }

        public function getTitle() { return $this->title; }
        public function getContent() { return $this->content; }
        public function getCreatedAt() { return $this->createdAt->format('Y-m-d H:i:s'); }
        public function getStatus() { return $this->status; }
        public function setStatus($newStatus) {$this->status = $newStatus;}
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

// print_r($usersList[0]->getUsername());

//     function displaymenuLogin()
//     {
//         // echo "\n=======================\n";
//         // echo "\n  BLOG - Login page    \n";
//         // echo "\n=======================\n";
        

//         // echo "Entre Your Email\n";
//         // echo "==> ";
//         // $email = trim(fgets(STDIN, 100));
//         // echo "Entre Your Password\n";
//         // echo "==> ";
//         // $password = trim(fgets(STDIN, 100));

//         // $user = User::login($email,$password);
//         // if ($user)
//         // {
//         //     echo "Connecté: " . $user->getUsername();
//         // }
//         // else
//         //     echo "We don't have this Account";
//     }

//     displaymenuLogin();

// 

?>
