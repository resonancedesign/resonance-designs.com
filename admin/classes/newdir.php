<?php 
class NewDir extends SplFileInfo {
    public function createThumbDirectory() {
        return $this->createSubDirectory('thumb');
    }
    public function createImageDirectory() {
        return $this->createSubDirectory('image');
    }
    private function createSubDirectory($name) {
        $path = $this->getPathname();
        return mkdir($path . './' . $name, 0755, true);
    }
}