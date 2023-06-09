<?php
class Post
{
    private $error = "";
    
    public function create_post($id, $data)
    {
            $post = addslashes($data['post']);
            $postid = $this->create_postid();

            $query = "INSERT INTO posts
            (postid, userid, post) 
            VALUES 
            ('$postid', '$id', '$post')";


            $DB = new Database();
            $DB->save($query);
    }
    
    private function create_postid()
    {
        $length = rand(4, 19);
        $number = "";
        for ($i=0; $i < $length; $i++)
        {
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }
        return $number;
    }
    
    public function get_posts($id){
        $query = "SELECT * FROM posts ORDER BY id DESC"; 


        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result;
        }else{
            return false;
        }
    }
}

?>