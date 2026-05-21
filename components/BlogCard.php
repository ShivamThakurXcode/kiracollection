<?php
function renderBlogCard($blog, $delay = '0.2s', $showFullExcerpt = false)
{
    $categoryColors = [
        'warning' => 'text-warning-dark bg-[rgba(255,193,7,0.16)]',
        'success' => 'text-success-dark bg-[rgba(84,214,44,0.16)]',
        'primary' => 'text-primary-dark bg-[rgba(0,171,85,0.16)]',
        'info' => 'text-info-dark bg-[rgba(32,201,151,0.16)]'
    ];

    $colorClass = isset($categoryColors[$blog['category_color']])
        ? $categoryColors[$blog['category_color']]
        : $categoryColors['warning'];

    $excerpt = $showFullExcerpt ? $blog['excerpt'] : (strlen($blog['excerpt']) > 100 ? substr($blog['excerpt'], 0, 100) . '...' : $blog['excerpt']);

    ?>
    <div class="wow animate__animated animate__fadeInUp" data-wow-delay="<?= $delay ?>">
        <div
            class="border border-gray-300 rounded-2xl p-6 hover:transform hover:translate-y-[-5px] hover:transition-all hover:ease-[cubic-bezier(0.02,0.01,0.47,1)] hover:duration-250 transition-all ease-[cubic-bezier(0.02,0.01,0.47,1)] duration-250 h-full flex flex-col">
            <div class="mb-6 aspect-[16/9] overflow-hidden rounded-2xl">
                <a href='blog-details.php?slug=<?= $blog['slug'] ?>'>
                    <img src="<?= $blog['image'] ?>" alt="<?= htmlspecialchars($blog['title']) ?>"
                        class="rounded-2xl w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                </a>
            </div>
            <div
                class="flex flex-col lg:flex-row divide-x-0 lg:divide-x divide-[rgba(145,158,171,0.24)] items-start justify-start lg:gap-y-0 gap-y-4 mb-4">
                <p class="text-light-secondary-text text-sm leading-[22px] inline-flex items-center gap-x-2 lg:pr-4 pr-0">
                    <span class="inline-flex items-center justify-center">
                        <i class="hgi hgi-stroke hgi-calendar-03 text-base leading-4 text-light-secondary-text"></i>
                    </span>
                    <span><?= $blog['date'] ?></span>
                </p>
                <p class="text-light-secondary-text text-sm leading-[22px] inline-flex items-center gap-x-2 pl-0 lg:pl-4">
                    <span class="inline-flex items-center justify-center">
                        <i class="hgi hgi-stroke hgi-tag-01 text-base leading-4 text-light-secondary-text"></i>
                    </span>
                    <a href='blog.php?category=<?= urlencode($blog['category']) ?>'
                        class="hover:text-primary transition-colors">
                        <?= htmlspecialchars($blog['category']) ?>
                    </a>
                </p>
            </div>
            <h6 class="mt-4 mb-3 hover:text-primary">
                <a href='blog-details.php?slug=<?= $blog['slug'] ?>'
                    class="text-lg font-semibold leading-7 text-light-primary-text hover:text-primary transition-colors">
                    <?= htmlspecialchars($blog['title']) ?>
                </a>
            </h6>
            <p class="mb-4 text-light-secondary-text text-sm leading-[22px] flex-grow">
                <?= htmlspecialchars($excerpt) ?>
            </p>
            <div class="mt-auto">
                <a class='btn btn-primary btn-large rounded-[60px] group py-2 pl-6 pr-3 gap-x-[18px] inline-flex items-center'
                    href='blog-details.php?slug=<?= $blog['slug'] ?>'>
                    Read More
                    <span
                        class="size-8 bg-white inline-flex items-center justify-center rounded-full rotate-[-40deg] transform group-hover:rotate-0 transition-all duration-300">
                        <i class="hgi hgi-stroke hgi-arrow-right-02 text-xl text-primary-darker"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <?php
}

function renderBlogCardSimple($blog, $delay = '0.2s')
{
    $categoryColors = [
        'warning' => 'text-warning-dark bg-[rgba(255,193,7,0.16)]',
        'success' => 'text-success-dark bg-[rgba(84,214,44,0.16)]',
        'primary' => 'text-primary-dark bg-[rgba(0,171,85,0.16)]',
        'info' => 'text-info-dark bg-[rgba(32,201,151,0.16)]'
    ];

    $colorClass = isset($categoryColors[$blog['category_color']])
        ? $categoryColors[$blog['category_color']]
        : $categoryColors['warning'];

    ?>
    <div class="wow animate__animated animate__fadeInUp" data-wow-delay="<?= $delay ?>">
        <div
            class="border border-gray-300 rounded-2xl p-6 hover:transform hover:translate-y-[-5px] hover:transition-all hover:ease-[cubic-bezier(0.02,0.01,0.47,1)] hover:duration-250 transition-all ease-[cubic-bezier(0.02,0.01,0.47,1)] duration-250">
            <div class="mb-6">
                <a href='blog-details.php?slug=<?= $blog['slug'] ?>'>
                    <img src="<?= $blog['image'] ?>" alt="<?= htmlspecialchars($blog['title']) ?>"
                        class="rounded-2xl w-full h-full object-cover" />
                </a>
            </div>
            <div class="flex divide-x divide-[rgba(145,158,171,0.24)]">
                <p class="text-light-secondary-text text-sm leading-[22px] inline-flex items-center gap-x-2 pr-4">
                    <span>
                        <i class="hgi hgi-stroke hgi-calendar-03 text-base text-light-secondary-text"></i>
                    </span>
                    <span><?= $blog['date'] ?></span>
                </p>
                <p class="text-light-secondary-text text-sm leading-[22px] inline-flex items-center gap-x-2 pl-4">
                    <span>
                        <i class="hgi hgi-stroke hgi-tag-01 text-base text-light-secondary-text"></i>
                    </span>
                    <a href='blog.php?category=<?= urlencode($blog['category']) ?>'
                        class="hover:text-primary transition-colors">
                        <?= htmlspecialchars($blog['category']) ?>
                    </a>
                </p>
            </div>
            <h6 class="mt-4 mb-3 hover:text-primary">
                <a href='blog-details.php?slug=<?= $blog['slug'] ?>'>
                    <?= htmlspecialchars($blog['title']) ?>
                </a>
            </h6>
            <p class="mb-4 text-light-secondary-text text-sm leading-[22px]">
                <?= htmlspecialchars($blog['excerpt']) ?>
            </p>
            <a class='btn btn-primary btn-large rounded-[60px] group py-2 pl-5 pr-3 inline-flex items-center'
                href='blog-details.php?slug=<?= $blog['slug'] ?>'>
                Read More
                <span
                    class="size-8 bg-white inline-flex items-center justify-center rounded-full rotate-[-40deg] transform group-hover:rotate-0 transition-all duration-300">
                    <i class="hgi hgi-stroke hgi-arrow-right-02 text-xl text-primary-darker"></i>
                </span>
            </a>
        </div>
    </div>
    <?php
}
?>