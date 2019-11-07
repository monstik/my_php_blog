<?php


namespace application\lib;


class Pagination
{
    public $max = 10;
    public $route;
    public $countPosts;
    public $currentPage;
    public $limit;
    public $pages;
    public $html = "<nav><ul class=\"pagination\">";

    public function __construct($route, $countPosts, $limit = 5)
    {
        $this->route = $route;
        $this->countPosts = $countPosts;
        $this->limit = $limit;
        $this->calculatePage();
        $this->setCurrentPage();
    }

    public function getPages()
    {
        return $this->generateHtml();
    }

    private function setCurrentPage()
    {
        if (!isset($this->route['page'])) {
            $this->currentPage = 1;
        } else {
            $this->currentPage = $this->route['page'];
        }
    }


    private function calculatePage()
    {
        if ($this->countPosts % $this->max == 0) {
            $this->pages = $this->countPosts / $this->max;
        } else {
            $this->pages = ceil($this->countPosts / $this->max);
        }
    }

    private function generateHtml()
    {
        if ($this->currentPage > 1) {
            $page = $this->currentPage - 1;
            $this->html .= "<li class=\"page-item \"><a class=\"page-link\" href=\"/" . $this->route['controller'] . '/' . $this->route['action'] . '/' . $page . '">' . 'Назад' . '</a></li>';
        }

        if ($this->currentPage - $this->limit > 0) {
            $start = $this->currentPage - $this->limit;
        }
        else{
            $start = 1;
        }
        for ($page = $start; $page <= $this->pages and $page < $this->currentPage+$this->limit; $page++) {
            if ($page == $this->currentPage and $page > 0) {
                $this->html .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"/" . $this->route['controller'] . '/' . $this->route['action'] . '/' . $page . '">' . $page . '</a></li>';
            } else {
                $this->html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"/" . $this->route['controller'] . '/' . $this->route['action'] . '/' . $page . '">' . $page . '</a></li>';
            }
        }

        if ($this->currentPage < $this->pages) {
            $page = $this->currentPage + 1;
            $this->html .= "<li class=\"page-item \"><a class=\"page-link\" href=\"/" . $this->route['controller'] . '/' . $this->route['action'] . '/' . $page . '">' . 'Вперед' . '</a></li>';
        }
        $this->html .= "</ul></nav>";
        return $this->html;
    }

}