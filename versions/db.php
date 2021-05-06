<?php

//This file has been scrapped (but not deleted)

/*

Questions:

  >What is a "class"?
    *In my own words, a class is basically an array but better; it allows you to assign properties and methods that make code easier to manage or use.
    *PHP Class reference and guide: https://www.php.net/manual/en/language.oop5.php
    
  >What is a "property"?
    *A property is basically a variable inside of a class, which can be accessed by doing "TheClass->Property"
    
  >What is a "method"?
    *A method is a function inside of a class. "TheClass->Method()"

Others:

  >Coding with teamwork
    *If you don't understand how to use the code below then we can do a thing where you write a comment in the code, and notify me on discord where you need me to write code at using the provided features in this file.
    *Try taking some time to learn about classes more by using the link listed under the question "What is a "class"?"
    
  >Help
    *If you need direct help to understand more about this, contact me on discord and I can try to help you understand more about how to use the features in this file
    *If you need help debugging an error also try to contact me about it, or if I'm unavaliable and the error isn't coming from this file then ask a question on stack overflow or another developer-related website
    
  >Purpose
    *The purpose of this file is to allow easy access to the database so we can easily do many things that we need to do throughout this project.
    
  >My specialties
    *I mainly do good in backend systems like this one for example
    *I am good at javascript; I have online friends that are much better than me but I know how to use the programming language to overcome obstacles.
  
  >My cons
    *I am not the best at HTML or CSS
    *I tend to forget a lot about contacting people, but I shouldn't forget in this project because it's a pretty big project; just encase please contact me whenever you get the chance to let me know that we need to attend to something or do something
  
  >How to setup
    *When you're creating file that needs access to the contents in this one, please do the steps below:
    
    //Start Information
    
    include("./db.php"); //Comes pre-included with "$Session" and "$DatabaseInfo" and "$BasePeriodJSON"
    
    //ONLY ADD THIS IF YOU NEED ACCESS TO THE DATABASE
    
    $Database = new UserDatabase($DatabaseInfo["Username"],$DatabaseInfo["Password"],$DatabaseInfo["DBName"]);
    $Database->Start();

Documentation on how to use all of the stuff below:

  >Variables:
    
    $DatabaseInfo //An array of all the information needed to connect to the database
    
    $BasePeriodJSON //A json-encoded array (a string) that is the base layout for the base data when a user signs up. It is assigned to all period columns inside the database
    
    $Session //A "UserSession" class that contains information on "Username", "UID", "LoggedIn", and "Periods". More about "UserSession" class under the classes category
    
    $Database //A "UserDatabase" class that is used as a proxy to connect to the SQLI Database. More about "UserDatabase" class under the classes category
    
  >Classes:
  
    class UserPeriod($Parent) //A class that is created inside of the "UserSession" class. This class serves the purpose of being used to get periods and period information from a specific user.
      *Properties:
      
        private $Data //An array that holds all of the period information, it is connected to the "UserSession" class
      
        private $Parent //The "UserSession" class that created
      
        private $PeriodData //An array that holds the specific names of keys inside of the $Data property. It is used to convert raw keys from the database to keys that are used inside the $_SESSION array.
      
      *Methods:
      
        ConvertPeriod($Name,$Type) //Returns a string based on the $Name input and the $Type input. Please see the examples category to understand more about how to use this method
      
        AddPeriod($Name,$Data) //Adds a Period to the $Data array. Please see the examples category to understand more about how to use this method

        GetPeriod($Name) //Returns an array of data based off what the $Name input is. Please see the examples category to understand more about how to use this method
        
        GetPeriodSave($Name) //Returns what GetPeriod($Name) returns but encoded in json
        
        ToSave() //Returns an array of all periods converted into JSON and all keys are the raw database keys that are used.
        
    class UserSession($Username,$UID) //A class that is a proxy to allow easy access of the session variable $_SESSION["UserInformation"]
    
      *Properties:
        
        private $Data //The session variable $_SESSION["UserInformation"]
        
        public $Periods //The "UserPeriod" class created by this class
        
      *Methods:
      
        SetUsername($Username) //Sets the "Username" variable inside of the $Data array
        
        SetUID($UID) //Sets the "UID" variable inside of the $Data array
        
        SetLogin($Login) //Sets the "LoggedIn" variable inside of the $Data array
        
        SetFirstName($Name) //Sets the "FName" variable inside of the $Data array
        
        SetLastName($Name) //Sets the "LName" variable inside of the $Data array
        
        Get($Name) //Returns the given variable $Name inside of the $Data array
        
        Reset() //Resets the entire $Data array to its default values
        
    class SQLResult($Result) //A proxy class that allows easy access to the data queired by the "SQLDatabase" class
    
      *Properties:
      
        private $Result //The raw result from the queired "SQLDatabase" class
        
      *Methods:
      
        GetRow($Number) //Returns an array of the given row inside of the $Result property
        
        Each($Callback) //Runs the given $Callback (a function) on all occurances inside the $Result property, the first two parameters sent to $Callback are "$Key, $Value" which reprentents the row number and the value in the row
        
        ToArray() //Returns an array of the entire $Result property
        
    class SQLDatabase($Username,$Password,$DBName) //A base class for accessing a database
      
      *Properties:
      
        private $Username //The username of the database
        
        private $Password //The password of the database
        
        private $DBName //The name of the database
        
        private $Connection //The raw connection of the database
        
        private $Started //A boolean that determines weather or not the database was started
        
      *Methods:
      
        Start() //Starts the database, so you can begin using other methods to do things with the database
        
        End() //Ends the database connection
        
        Query($SQL) //Queries the given $SQL code and returns the results
        
        GetFrom($TableName) //Returns a "SQLResult" class with the given results, this method will get the given table inside the database
        
        InsertTo($TableName,$Values) //Inserts the given values into the given table inside the database. $Values is structured as ["Key"=>"Value",...]
        
        DeleteFrom($TableName,$VariableName,$VariableValue) //Will delete a column inside the table in the database if the key $VariableName equals $VariableValue
        
        UpdateIn($TableName,$VariableName,$VariableValue,$Values) //Will update the given $Values inside of the table in the database if the key $VariableName equals $VariableValue. $Values is structured as ["Key"=>"Value",...]
        
    class UserDatabase($Username,$Password,$DBName) //A class that extends the "SQLDatabase" class and allows for methods that will easily allow you to modify or get things inside the "users" and "schedules" table(s)
      
      *Properties:
      
      *Methods:
      
        UserExists($Username) //Returns a boolean on weather or not the given $Username already exists inside of the "users" table in the database
        
        GetUserCredentials($Username) //Returns an array of data that is the $Username's data inside the "users" table
        
        SignUp($Username,$Password,$FName,$LName,$Email) //It basically explains itself, it will add all of these variables to the "users" table inside of the database (It cannot overwrite existing user data)
        
        Login($Username,$Password) //This method will log in the given user if the $Username and $Password matches the data inside the "users" table. The user must exist before this method can be used. This method will update the $Session variable's data to match the user's data
        
        Logout() //This method will log out the given user if they are signed in. This method will reset the $Session variable's data
        
        ChangePassword($Username,$NewPassword) //This method will change the given user's password to the new password provided
        
        GetPeriods() //This method will return an array of the periods inside the database that the user has
        
        SavePeriods($UID,$PeriodData) //This method will update the given periods inside the $PeriodData array inside of the user's periods in the "schedule" table
        
        SavePeriod($UID,$Name,$Data) //This method does basically the same thing as "SavePeriods" but it updates one period only
        
  >Examples:
    
    //Listed below is an example of everything useful above
    
    //UserSession & UserPeriod
    
    $Session = new UserSession();
    $Session->SetUsername("Username");
    $Session->SetUID(1);
    $Session->SetLogin(true);
    echo $Session->Get("Username") . "<br>"; //"Username"
    $Session->Reset();
    echo $Session->Get("Username") . "<br>"; //"" (It's a blank string)
    echo $Session->Get("LoggedIn") . "<br>"; //"false" (Not logged in)
    
    $Period =& $Session->Periods;
    
    echo $Period->ConvertPeriod("Period1","to"); //"per1"
    echo $Period->ConvertPeriod("per1","from"); //"Period1"
    
    $Period->AddPeriod("Period1",["Key"=>"Value"]);
    var_dump($Period->GetPeriod("Period1"));echo "<br>"; //"array(1) { ["Key"]=> string(5) "Value" } "
    echo $Period->GetPeriodSave("Period1") . "<br>"; //"{"Key":"Value"}" (A JSON table)
    echo $Period->ToSave() . "<br>"; //"[{"Key":"Value"}]" (A JSON array with all the periods it saved)
    
    //SQLDatabase & SQLResult & UserDatabase
    
    $Database = new UserDatabase("Username","Password","DBName");
    $Database->Start();
    
    $Database->SignUp("Sebastian","Password123","Sebastian","Autry","353425@guhsd.net");
    
    $Result = $Database->GetFrom("users");
    $Result->Each(function($Key,$Value){
      print_r($Value);echo "<br>";
    }); //"Array ( [uid] => 1 [username] => Sebastian [password] => Password123 [fName] => Sebastian [lName] => Autry [email] => 353425@guhsd.net )"
    
    print_r($Results->GetRow(0));echo "<br>"; //"Array ( [uid] => 1 [username] => Sebastian [password] => Password123 [fName] => Sebastian [lName] => Autry [email] => 353425@guhsd.net )"
    
    print_r($Results->ToArray());echo "<br>"; //"Array ( [0] => Array ( [uid] => 1 [username] => Sebastian [password] => Password123 [fName] => Sebastian [lName] => Autry [email] => 353425@guhsd.net ) )"
    
    print_r($Database->GetUserCredentials("Sebastian"));echo "<br>"; //"Array ( [uid] => 1 [username] => Sebastian [password] => Password123 [fName] => Sebastian [lName] => Autry [email] => 353425@guhsd.net )"
    
    echo $Database->UserExists("Sebastian") . "<br>"; //"true"
    echo $Database->UserExists("Larry") . "<br>"; //"false"
    
    $Database->SavePeriod(1,"per1","{"Key":"Value"}");
    
    $Result1 = $Database->GetPeriods(1);
    $Result1->Each(function($Key,$Value){
      print_r($Value);echo "<br>";
    }); //"Aray( [uid] => 1 [userUID] => 1 [per1] => Array ( [Key] => Value ) ... )" (I am unsure if this is the result, as I have been unable to test anything related to periods because the schedule table isn't working properly)
    
    $Database->DeleteFrom("users","uid",1); //Should allow you to run this code again
    $Database->DeleteFrom("schedule","userUID",1); //Should allow you to run this code again
    
    $Database->Logout();
    
    $Database->End();
  
  >Notes:
    
    *You don't need to worry about using $Database->GetPeriods to update the periods array in the session, logging in and signing up automatically does it for you; one thing you may need to do is when saving periods, you might have to add the period to the session yourself.
    
    *Use the session as much as possible to get period data and other information like Username and UID because I feel like we should send as little requests as possible to the database
  
*/

session_start();

$DatabaseInfo = [
  "Username"=>"benrud_scheduleA",
  "Password"=>"Zu=xeN{vYXkj",
  "DBName"=>"benrud_scheduleApp",
];

//Make sure you split the time using the splitter "/" 
//Time format as military time "HH/MM", use math to turn it into the normal time format:
/*

function FromMilitaryHour($Hour){
  if ($Hour > 12){
    return $Hour - 12;
  }
  return $Hour;
}

*/

$BasePeriodJSON = [
  "TeacherName"=>"None",
  "ClassName"=>"None",
  "StartTime"=>"00/00",
  "EndTime"=>"00/00",
];

$BasePeriodJSON = json_encode($BasePeriodJSON);

class UserPeriod {
  private $Parent;
  private $Data = [];
  private $PeriodData = ["Period1"=>"per1","Period2"=>"per2","Period3"=>"per3","Period4"=>"per4","Period5"=>"per5","Period6"=>"per6","Period7"=>"per7","Period8"=>"per8","Period0"=>"per0"];
  public function __construct($Parent){
    $this->Parent = $Parent;
    $this->Data = $Parent->Get("Periods");
  }
  public function ConvertPeriod($Name,$Type){
    if (strtolower($Type) == "to"){
      return $this->PeriodData[$Name];
    } else if (strtolower($Type) == "from"){
      return array_search($Name,$this->PeriodData);
    }
  }
  public function Reset(){
    $this->Data = [];
  }
  public function AddPeriod($Name,$Data){
    if (substr($Name,0,3) === "per"){
      $Name = $this->ConvertPeriod($Name,"from");
    }
    if (!$Name){return;}
    $this->Data[$Name] = $Data;
    $this->Parent->SetPeriods($this->Data);
  }
  public function GetPeriod($Name){
    if (substr($Name,0,3) === "per"){
      $Name = $this->ConvertPeriod($Name,"from");
    }
    return $this->Data[$Name];
  }
  public function GetPeriodSave($Name){
    return json_encode($this->Data[$Name]);
  }
  public function ToSave(){
    $Arr = [];
    foreach ($this->Data as $Key=>$Value){
      $Arr[$this->ConvertPeriod($Key,"to")] = json_encode($Value);
    }
    return $Arr;
  }
};

class UserSession {
  private $Data;
  public $Periods;
  public function __construct($Username="",$UID=0){
    if (!isset($_SESSION["UserInformation"])){
      $_SESSION["UserInformation"] = ["Username"=>$Username,"UID"=>$UID,"LoggedIn"=>false,"Periods"=>[],"LName"=>"","FName"=>""];  
    }
    $this->Data =& $_SESSION["UserInformation"];
    $this->Periods = new UserPeriod($this);
  }
  public function SetUsername($Username=""){
    $this->Data["Username"] = $Username;
  }
  public function SetUID($UID=0){
    $this->Data["UID"] = $UID;
  }
  public function SetLogin($Login){
    $this->Data["LoggedIn"] = $Login;
  }
  public function SetFirstName($Name){
    $this->Data["FName"] = $Name;
  }
  public function SetLastName($Name){
    $this->Data["LName"] = $Name;
  }
  public function Get($Name){
    return $this->Data[$Name];
  }
  public function Reset(){
    $this->Data["Username"] = "";
    $this->Data["UID"] = 0;
    $this->Data["LoggedIn"] = false;
    $this->Data["Periods"] = [];
    $this->Periods->Reset();
  }
  public function SetPeriods($Data){
    $this->Data["Periods"] = $Data;
  }
};

$Session = new UserSession();

class SQLResult {
  private $Result;
  public function __construct($Result){
    $this->Result = $Result;
    $this->Count = $Result->num_rows;
  }
  public function GetRow($Number = 0){
    $this->Result->data_seek($Number);
    return $this->Result->fetch_assoc();
  }
  public function Each($Callback){
    $Result;
    for ($Number = 0;$Number<=$this->Count-1;$Number++){
      $Result = $Callback($Number,$this->GetRow($Number));
      if ($Result === true){
        break;
      }
    }
    return $Result;
  }
  public function ToArray(){
    $Arr = [];
    for ($Number = 0;$Number<=$this->Count-1;$Number++){
      $Arr[$Number] = $this->GetRow($Number);
    }
    return $Arr;
  }
};

class SQLDatabase {
  private $Username;
  private $Password;
  private $DBName;
  private $Connection;
  private $Started = false;
  public function __construct($Username = "",$Password = "",$DBName = ""){
      $this->Username = $Username;
      $this->Password = $Password;
      $this->DBName = $DBName;
  }
  public function Start(){
      if ($this->Started){return;}
      $TempConnection = new mysqli("localhost",$this->Username,$this->Password,$this->DBName);
      if ($TempConnection->connect_error){
        die("SQLDatabase Connection failed: " . $TempConnection->connect_error);
      }
      $this->Started = true;
      $this->Connection =& $TempConnection;
  }
  public function End(){
    if (!$this->Started){return;}
    $this->Connection->close();
  }
  public function Query($SQL=""){
    if (!$this->Connection){return;}
    $Result = $this->Connection->query($SQL);
    if (!$Result){
      die("[SQL ERROR ON CODE \"" . $SQL . "\"]: " . $this->Connection->error);
    }
    return $Result;
  }
  public function GetFrom($TableName = ""){
      if (!$this->Connection){return;}
      $Result = new SQLResult($this->Query("SELECT * FROM " . $TableName . ""));
      return $Result;
  }
  public function InsertTo($TableName = "",$Values = []){
    $VariableNames = "";
    $VariableValues = "";
    foreach ($Values as $Key=>$Value){
      if (gettype($Value) == "string"){
        $Value = "\"$Value\"";
      }
      $VariableNames .= $Key .",";
      $VariableValues .= $Value . ",";
    };
    $VariableNames = substr($VariableNames,0,strlen($VariableNames)-1);
    $VariableValues = substr($VariableValues,0,strlen($VariableValues)-1);
    if (!$this->Connection){return;}
    $this->Query("INSERT INTO ".$TableName."(".$VariableNames.") VALUES (".$VariableValues.")");
  }
  public function DeleteFrom($TableName = "",$VariableName="",$VariableValue=""){
    if (!$this->Connection){return;}
    if (gettype($VariableValue) == "string"){
      $VariableValue = "\"$VariableValue\"";
    }
    $this->Query("DELETE FROM ".$TableName." WHERE ".$VariableName."=".$VariableValue);
  }
  public function UpdateIn($TableName ="",$VariableName="",$VariableValue="",$Values=[]){
    if (!$this->Connection){return;}
    if (gettype($VariableValue) == "string"){
      $VariableValue = "\"$VariableValue\"";
    }
    $Result = "";
    foreach ($Values as $Key=>$Value){
      if (gettype($Value) == "string"){
        $Value = "\"$Value\"";
      }
      $Result .= $Key . "=" . $Value . ",";
    };
    $Result = substr($Result,0,strlen($Result)-1);
    $this->Query("UPDATE $TableName SET $Result WHERE $VariableName=$VariableValue");
  }
};

class UserDatabase extends SQLDatabase{
  public function __construct($Username="",$Password="",$DBName=""){
    parent::__construct($Username,$Password,$DBName);
  }
  public function UserExists($Username){
    $Result = $this->GetFrom("users");
    $Result = $Result->ToArray();
    foreach ($Result as $Key=>$Value){
      if ($Username == $Value["username"]){
        return true;
      }
    }
    return false;
  }
  public function GetUserCredentials($Username){
    if (!$this->UserExists($Username)){return;}
    $Result = $this->Query("SELECT * FROM `users` WHERE username=\"".$Username."\"");
    if (!$Result){return;}
    $Result = new SQLResult($Result);
    return $Result->ToArray()[0];
  }
  public function SignUp($Username="",$Password="",$FName="",$LName="",$Email=""){
    global $Session,$BasePeriodJSON;
    if ($this->UserExists($Username) === true){return false;}
    $Result = $this->GetFrom("users");
    $Result1 = $this->GetFrom("schedules");
    $this->InsertTo("users",["uid"=>intval($Result->Count+1),"username"=>$Username,"password"=>$Password,"fName"=>$FName,"lName"=>$LName,"email"=>$Email]);
    $this->InsertTo("schedules",["uid"=>intval($Result1->Count+1),"userUID"=>intval($Result->Count+1),"per1"=>$BasePeriodJSON,"per2"=>$BasePeriodJSON,"per3"=>$BasePeriodJSON,"per4"=>$BasePeriodJSON,"per5"=>$BasePeriodJSON,"per6"=>$BasePeriodJSON,"per7"=>$BasePeriodJSON,"per8"=>$BasePeriodJSON,"per0"=>$BasePeriodJSON]);
    $Session->SetUsername($Username);
    $Session->SetUID($Result->Count+1);
    $Session->SetLogin(true);
    $Session->SetFirstName($FName);
    $Session->SetLastName($LName);
    $Periods = ["per1"=>$BasePeriodJSON,"per2"=>$BasePeriodJSON,"per3"=>$BasePeriodJSON,"per4"=>$BasePeriodJSON,"per5"=>$BasePeriodJSON,"per6"=>$BasePeriodJSON,"per7"=>$BasePeriodJSON,"per8"=>$BasePeriodJSON,"per0"=>$BasePeriodJSON];
    foreach ($Periods as $Key=>$Value){
      $Session->Periods->AddPeriod($Key,json_decode($Value));
    }
    return true;
  }
  public function Login($Username,$Password){
    global $Session,$BasePeriodJSON;
    if ($Session->Get("LoggedIn")){echo "Already logged in!<br>";return false;}
    $Credentials = $this->GetUserCredentials($Username);
    if (!$Credentials){echo "Invalid username!<br>";return false;}
    if ($Credentials["username"] != $Username || $Credentials["password"] != $Password){echo "Invalid password or username!<br>";return false;}
    $Session->SetUsername($Username);
    $Session->SetUID($Credentials["uid"]);
    $Session->SetLogin(true);
    $Session->SetFirstName($Credentials["fName"]);
    $Session->SetLastName($Credentials["lName"]);
    $Periods = $this->GetPeriods($Credentials["uid"]);
    foreach ($Periods as $Key=>$Value){
      $Session->Periods->AddPeriod($Key,json_decode($Value));
    }
    return true;
  }
  public function Logout(){
    global $Session;
    if (!$Session->Get("LoggedIn")){echo "Not logged in!<br>";return false;}
    $Session->Reset();
    echo "Logged out!<br>";
    return true;
  }
  public function ChangePassword($Username,$NewPassword){
    $this->UpdateIn("users","username",$Username,["password"=>$NewPassword]);
  }
  public function GetPeriods($UID=0){
    if ($UID==0){return false;}
    $Result = $this->Query("SELECT * FROM `schedules` WHERE userUID=$UID");
    if (!$Result){return false;}
    $Result = new SQLResult($Result);
    return $Result->ToArray()[0];
  }
  public function SavePeriods($UID=0,$PeriodData){
    if ($UID==0){return false;}
    $this->UpdateIn("schedules","userUID",$UID,$PeriodData);
  }
  public function SavePeriod($UID=0,$Name,$Data){
    if ($UID==0){return false;}
    $this->UpdateIn("schedules","userUID",$UID,[$Name=>$Data]);
  }
}


$Database = new UserDatabase($DatabaseInfo["Username"],$DatabaseInfo["Password"],$DatabaseInfo["DBName"]);
$Database->Start();
//$Database->InsertTo("web_projects",["uid"=>3,"project_name"=>"test","project_url"=>"test","project_description"=>"test"]);
//$Database->DeleteFrom("users","uid",1);
//$Database->UpdateIn("web_projects","uid",1,["project_description"=>"Hello, world!"]);
$Database->SignUp("Sebastian","Password123","Sebastian","Autry","353425@guhsd.net");
//$Result1 = $Database->GetUserCredentials("Sebastian");
//$Database->ChangePassword("Test","Password123");
//$Database->Login("Sebastian","Password123");
//$Database->Logout();
//var_dump($_SESSION["UserInformation"]);

$Database->End();

//Below is for debugging purposes
/*

$Period =& $Session->Periods;
$Period->AddPeriod("Period1",json_decode($BasePeriodJSON));
$Period->AddPeriod("Period2",json_decode($BasePeriodJSON));
$Period->AddPeriod("Period3",json_decode($BasePeriodJSON));
$Period->AddPeriod("Period4",json_decode($BasePeriodJSON));
$Period->AddPeriod("Period5",json_decode($BasePeriodJSON));
$Period->AddPeriod("Period6",json_decode($BasePeriodJSON));
$Period->AddPeriod("Period7",json_decode($BasePeriodJSON));
$Period->AddPeriod("Period8",json_decode($BasePeriodJSON));
$Period->AddPeriod("Period0",json_decode($BasePeriodJSON));
var_dump($_SESSION["UserInformation"]);
//$Session->Reset()

//The Query method
public function Query($SQL=""){
   if (!$this->Connection){return;}
   $Result = $this->Connection->query($SQL);
   if (!$Result){
      die("[SQL ERROR ON CODE \"" . $SQL . "\"]: " . $this->Connection->error);
   }
   return $Result;
}

//The GetFrom method
public function GetFrom($TableName = ""){
   if (!$this->Connection){return;}
   $Result = new SQLResult($this->Query("SELECT * FROM " . $TableName . ""));
   return $Result;
}

//A line of code inside of the method that produces the error (I commented it out and it worked just fine)
$Result1 = $this->GetFrom("schedules");

//The method that starts the error
$Database->SignUp("Sebastian","Password123","Sebastian","Autry","353425@guhsd.net");

*/

?>
