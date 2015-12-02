<?php

interface DAOInterface{
   public function findById($id);
   public function create($objeto);
   public function update($objeto);
   public function delete($objeto);
   public function listAll();
}

