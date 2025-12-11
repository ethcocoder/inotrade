<?php
require_once 'BaseModel.php';

class ContactMessage extends BaseModel {
    protected $table = 'contact_messages';
    protected $fillable = ['name', 'email', 'message', 'is_read'];

    public function markAsRead($id) {
        return $this->update($id, ['is_read' => 1]);
    }
    
    public function getUnreadCount() {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE is_read = 0";
        $result = $this->db->fetch($sql);
        return $result['count'];
    }
}
?>
