<?php
class Login
{
    
    private $error = "";
    
    public function evaluate($data)
    {
      
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

       
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

        
        $DB = new Database();
      
        $result = $DB->read($query);

        
        if($result)
        {
           
            $row = $result[0];

            
            if($password == $row['password'])
            {
                
                $_SESSION['userid'] = $row['userid'];

           
            }else
            {
                
                $this->error .= "Wrong Password<br>";
            }

        }else
        {
            
            $this->error .= "No such email was found<br>";
        }
        
        return $this->error;
    }

    public function change_pass($data, $id)
    {
        $query = "SELECT userid FROM users WHERE userid = '$id' limit 1";
        
        $password = addslashes($data['password']);
        $password = addslashes($data['newpassword']);

        $DB = new Database();
        $result = $DB->read($query);

        $row = $result[0];
        if($result)
        {
            if($password == $row['password'])
            {
                $newpassword = $data['newpassword'];
                $query = "UPDATE users SET password = '$newpassword' WHERE userid = '$id' LIMIT 1";
                $DB = new Database();
                $DB->save($query);
            }else
            {
                $this->error .= "Wrong Password<br>";
            }
        }else{
            return false;
        }
    }

    public function check_login($id)
    {
        $query = "SELECT userid FROM users WHERE userid = '$id' limit 1";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return true;
        }
        return false;
    }
}