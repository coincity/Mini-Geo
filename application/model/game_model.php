<?php
class gameModel
{
    /**
     * @param object $db A PDO database connection
     */


    public function getlatlng($photo)
    {
        $sql = "SELECT lat,lng FROM photos WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $photo);
        $query->execute($parameters);

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetch();
    }
    public function play($id)
    {
        if ($id == "random") {
        $sql = "SELECT id,location FROM photos ORDER BY Rand() LIMIT 1";
        } else {
        $sql = "SELECT id,location FROM photos WHERE id = :id";
        }
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }
}
?>