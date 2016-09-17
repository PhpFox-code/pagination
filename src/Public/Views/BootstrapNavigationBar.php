<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($firstLink) : ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $firstLink ?>" tabindex="-1" aria-label="First">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">First</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if ($prevLink) : ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $prevLink ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        <?php endif; ?>
        <?php foreach ($links as $number => $link) : ?>
            <?php if ($currentPage == $number) : ?>
                <li class="page-item active">
                    <a class="page-link" href="<?php echo $link ?>"><?php echo $number ?> <span class="sr-only">(current)</span></a>
                </li>
            <?php else : ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $link ?>"><?php echo $number ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($nextLink) : ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $nextLink ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if ($lastLink) : ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $lastLink ?>" aria-label="Last">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Last</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>