<?php
session_start();

function is_logged_in() {
  return isset($_SESSION['username']);
}

function is_admin() {
  return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function current_user_name() {
  return $_SESSION['username'] ?? null;
}