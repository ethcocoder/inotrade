<?php
require_once 'BaseModel.php';

class ContactMessage extends BaseModel {
    protected $table = 'contact_messages';
    protected $fillable = ['name', 'email', 'message', 'is_read'];

    public function markAsRead($id) {
        return $this->update($id, ['is_read' => 1]);
    }
    
    public function create($data) {
        // Only allow fillable fields
        $data = array_intersect_key($data, array_flip($this->fillable));
        // BaseModel adds created_at/updated_at, but we don't have updated_at.
        // We let DB handle created_at via DEFAULT CURRENT_TIMESTAMP, or we can set it.
        // Let's just insert strictly fillable data.
        return $this->db->insert($this->table, $data);
    }
    
    public function getUnreadCount() {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE is_read = 0";
        $result = $this->db->fetch($sql);
        return $result['count'];
    }
}
?>
