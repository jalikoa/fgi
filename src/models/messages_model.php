<?php
/**
 * Future guardians initiative 
 *
 * @see       https://github.com/jalikoa/fgi/ The future guardians repository
 * @author    Calvince Owino Jalikoa (Kenya) <d34calvo@gmail.com>
 * @copyright 2024 - 2025 Calvince Owino CEO Jalsoft
 * @license   Thi programe is written for the specific needs of future guardians initiative and no part can be taken away without prior permissions
 * CEO JalSoft Calvince Owino
 * @see contact at +254799311413
 */
namespace jalikoa\FGIprogramme;
class message {
    private $message_list;
    private $message;
    private $sender;
    private $discussion;
    private $type;#edited or original i.e orig->0 edited->1 forwarded -> 2
    private $reply_to;#if reply have the mess_id for the reply else default 0

    public function setCred($sender,$message,$discussion,$type,$reply_to){
        if(empty($message) || empty($sender) || empty($discussion) || empty($type) || empty($reply_to)){
            return false;
        } else {
            $this->sender = $sender;
            $this->message = $message;
            $this->discussion = $discussion;
            $this->type = $type;
            $this->reply_to = $reply_to;
            return true;
        }
    }
    public function check_is_blocked(){
        //Add logics in this function and aim at checkin when user is blocked by admin in the forum
    }
    public function send_message($conn){
        $send = "INSERT INTO messages (sender,message,discussion,type,reply_to) VALUES ('$this->sender','$this->message','$this->discussion','$this->type','$this->reply_to')";
        $res = $conn->query($res);
        return ($res)?true:false;        
    }
    public function edit_message($conn,$new_sms,$messid){
        $edit = "UPDATE messages SET message = '$new_sms',type = '1' WHERE id = '$messid'";
        $res = $conn->query($edit);
        return ($res)?true:false;
    }
    public function delete_message($conn,$messid){
        $del = "UPDATE messages SET message = 'Deleted',type = '0' WHERE id = '$messid'";
        $res = $conn->query($del);
        return ($res)?true:false;
    }
    public function fetch_messages($conn){
        #join tables to make it more easier for you to display the data when it comes to the front end
        $fetch = "SELECT  ";
    }
    public function Check_is_member($conn,$userid,$disid){
        $check = "SELECT * FROM dissmembers WHERE user_id = '$userid' AND discussion_id = '$disid'";
        $res=$conn->query($check);
        return ($res->num_rows > 0)?true:false;
    }
    public function get_messages($conn){
        $fetch = "SELECT *";
        //Update this to make the messages to be fetched togethere with the sender credentials
    }
    public function get_mess_list(){
        return $this->message_list;
    }
}