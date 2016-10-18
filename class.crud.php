<?php

class db
{ 
	private $db;
 
	function __construct($DB_con)
	{
	  $this->db = $DB_con;
	}
 
	public function insertPDO($firstname,$middlename,$lastname,$email,$password)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO persons (firstname, middlename, lastname,email,password,status)
			VALUES (:firstname, :middlename,:lastname,:email, :password,1)");
				 $stmt->bindparam(":firstname",$firstname);
				 $stmt->bindparam(":middlename",$middlename);
				 $stmt->bindparam(":lastname",$lastname);
				 $stmt->bindparam(":email",$email);
				 $stmt->bindparam(":password",$password);
					 $stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}

	}

	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM persons WHERE person_id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	 
 	public function update($id,$firstname,$middlename,$lastname,$email)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE persons SET firstname=:firstname,middlename=:middlename,lastname=:lastname,email=:email WHERE person_id=:id ");
			$stmt->bindparam(":firstname",$firstname);
			$stmt->bindparam(":middlename",$middlename);
			$stmt->bindparam(":lastname",$lastname);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":id",$id);
			$stmt->execute();

			return true; 
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}
	}
	 
	public function delete($id)
	{
		$stmt = $this->db->prepare("UPDATE persons SET status = 0 WHERE person_id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	 
	 /* paging */
	 
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			?>
			            <tr>
			            <td><?php print($row['firstname']); ?></td>
			            <td><?php print($row['middlename']); ?></td>
			            <td><?php print($row['lastname']); ?></td>
			            <td><?php print($row['email']); ?></td>
			            <td align="center">
			            <a href="update.php?edit_id=<?php print(password_hash($row['person_id'],PASSWORD_DEFAULT).';'.$row['person_id'].';'.password_hash('generatedpassword',PASSWORD_DEFAULT)); ?>"><i class="glyphicon glyphicon-edit"></i></a>
			            </td>
			            <td align="center">
			            <a href="delete.php?delete_id=<?php print(password_hash($row['person_id'],PASSWORD_DEFAULT).';'.$row['person_id'].';'.password_hash('generatedpassword',PASSWORD_DEFAULT)); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
			            </td>
			            </tr>
			            <?php
			}
		}
		else
		{
		?>
		        <tr>
		        <td>Nothing here...</td>
		        </tr>
		        <?php
		}

	}
	 
	 public function paging($query,$records_per_page)
	 {
	  $starting_position=0;
	  if(isset($_GET["page_no"]))
	  {
	   $starting_position=($_GET["page_no"]-1)*$records_per_page;
	  }
	  $query2=$query." limit $starting_position,$records_per_page";
	  return $query2;
	 }
	 
	 public function paginglink($query,$records_per_page)
	 {
	  
	  $self = $_SERVER['PHP_SELF'];
	  
	  $stmt = $this->db->prepare($query);
	  $stmt->execute();
	  
	  $total_no_of_records = $stmt->rowCount();
	  
	  if($total_no_of_records > 0)
	  {
	   ?><ul class="pagination"><?php
	   $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
	   $current_page=1;
	   if(isset($_GET["page_no"]))
	   {
	    $current_page=$_GET["page_no"];
	   }
	   if($current_page!=1)
	   {
	    $previous =$current_page-1;
	    echo "<li><a href='".$self."?page_no=1'>First</a></li>";
	    echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
	   }
	   for($i=1;$i<=$total_no_of_pages;$i++)
	   {
	    if($i==$current_page)
	    {
	     echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
	    }
	    else
	    {
	     echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
	    }
	   }
	   if($current_page!=$total_no_of_pages)
	   {
	    $next=$current_page+1;
	    echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
	    echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
	   }
	   ?></ul><?php
	  }
	 }
	 
	 /* paging */
	 


}


?>
