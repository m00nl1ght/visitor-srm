<?php  
/* Specify the server and connection string attributes. */  
$serverName = "sqlironbase\sharedinstance";  
$options = [
   'Database' => 'IronBase6', // название БД, к которой подключаемся
   'CharacterSet' => 'UTF-8'
];
/* Connect using Windows Authentication. */  
$conn = sqlsrv_connect( $serverName, $options );  
if( $conn === false )  
{  
     echo "Unable to connect.</br>";  
     die( print_r( sqlsrv_errors(), true));  
}  
  
/* Query SQL Server for the login of the user accessing the  
database. */  
$tsql = "SELECT f.Name, m.Name, u.NetworkName, u.InventoryNumber, u.SerialNumber 
FROM Units u
LEFT JOIN Folders f ON u.ParentFolderID = f.FolderID
LEFT JOIN Models m ON u.ModelID = m.ModelID 
WHERE u.NetworkName  LIKE N'%N2210286%'";  
$stmt = sqlsrv_query( $conn, $tsql);  
if( $stmt === false )  
{  
     echo "Error in executing query.</br>";  
     die( print_r( sqlsrv_errors(), true));  
}  
  
/* Retrieve and display the results of the query. */  
$row = sqlsrv_fetch_array($stmt);  
echo "User login: ".$row[0]."</br>";  
echo "User login: ".$row[1]."</br>"; 
echo "User login: ".$row[2]."</br>"; 
echo "User login: ".$row[3]."</br>"; 
/* Free statement and connection resources. */  
sqlsrv_free_stmt( $stmt);  
sqlsrv_close( $conn); 
?> 