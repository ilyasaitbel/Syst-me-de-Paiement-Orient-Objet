<?php
interface BaseRepository {
    public function findAll();
    public function findById($id);
    public function create($o);
    public function update($o);
    public function delete($id);
}
