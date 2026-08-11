<?php
require_once '../app/config/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM users ORDER BY id DESC";
        $result = $this->db->query($query);
        $users = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function getById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

public function create($data) {
    $query = "INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("sssss", $data['name'], $data['email'], $hashedPassword, $data['phone'], $data['address']);

    if($stmt->execute()) {
        return $this->db->insert_id;
    }

    return false;
}

    public function update($id, $data) {
        if (!empty($data['password'])) {
            $query = "UPDATE users SET name = ?, email = ?, password = ?, phone = ?, address = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt->bind_param("sssssi", $data['name'], $data['email'], $hashedPassword, $data['phone'], $data['address'], $id);
        } else {
            $query = "UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssssi", $data['name'], $data['email'], $data['phone'], $data['address'], $id);
        }

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateProfileImage($id, $profileImage) {
    $query = "UPDATE users SET profile_image = ? WHERE id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("si", $profileImage, $id);

    return $stmt->execute();
}

}
