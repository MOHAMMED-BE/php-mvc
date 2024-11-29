<?php

class PaginationHelper
{
    public static function paginate($totalItems, $itemsPerPage, $currentPage, $baseUrl)
    {
        $totalPages = ceil($totalItems / $itemsPerPage);
        $paginationHtml = '<nav><ul class="pagination justify-content-start">';

        //% Previous Button
        $previousPage = max(1, $currentPage - 1);
        $disabledPrev = $currentPage == 1 ? 'disabled' : '';
        $paginationHtml .= '<li class="page-item ' . $disabledPrev . '">';
        $paginationHtml .= '<a class="page-link" href="' . $baseUrl . '&page=' . $previousPage . '">Previous</a>';
        $paginationHtml .= '</li>';

        //% Page Numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = $i == $currentPage ? 'active' : '';
            $paginationHtml .= '<li class="page-item ' . $active . '">';
            $paginationHtml .= '<a class="page-link" href="' . $baseUrl . '&page=' . $i . '">' . $i . '</a>';
            $paginationHtml .= '</li>';
        }

        //% Next Button
        $nextPage = min($totalPages, $currentPage + 1);
        $disabledNext = $currentPage == $totalPages ? 'disabled' : '';
        $paginationHtml .= '<li class="page-item ' . $disabledNext . '">';
        $paginationHtml .= '<a class="page-link" href="' . $baseUrl . '&page=' . $nextPage . '">Next</a>';
        $paginationHtml .= '</li>';

        $paginationHtml .= '</ul></nav>';

        return $paginationHtml;
    }
}
