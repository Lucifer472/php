<header class="w-full h-20 md:h-24 bg-gray-600 shadow-md">
    <nav class="flex items-center h-full justify-between global-container">
        <div class="flex items-center justify-center max-h-fit gap-2">
            <a href="<?php echo $url ?>">
                <img src="<?php echo $url ?>/asset/logo.svg" alt="Logo">
            </a>
        </div>
        <ul class="hidden md:flex items-center justify-center gap-4">
            <li class="flex items-center justify-center p-4 hover:bg-black/70 rounded-md">
                <a href="<?php echo $url ?>/questionbank" class="flex items-center justify-center gap-2 text-white">
                    <figure>
                        <img src="<?php echo $url ?>/asset/icons/book.svg" alt="" class="w-6 h-6">
                    </figure>
                    <span>Question Bank</span>
                </a>
            </li>
            <li class="flex items-center justify-center p-4 hover:bg-black/70 rounded-md">
                <a href="<?php echo $url ?>/exam" class="flex items-center justify-center gap-1 text-white">
                    <figure>
                        <img src="<?php echo $url ?>/asset/icons/exam.svg" alt="" class="w-6 h-6">
                    </figure>
                    <span>Exam</span>
                </a>
            </li>
            <li class="flex items-center justify-center p-4 hover:bg-black/70 rounded-md">
                <a href="<?php echo $url ?>/blog" class="flex items-center justify-center gap-2 text-white">
                    <figure>
                        <img src="<?php echo $url ?>/asset/icons/blog.svg" alt="" class="w-6 h-6">
                    </figure>
                    <span>Blogs</span>
                </a>
            </li>
            <li class="flex items-center justify-center p-4 hover:bg-black/70 rounded-md">
                <a href="<?php echo $url ?>/settings" class="flex items-center justify-center gap-2 text-white">
                    <figure>
                        <img src="<?php echo $url ?>/asset/icons/help.svg" alt="" class="w-6 h-6">
                    </figure>
                    <span>Settings & Help</span>
                </a>
            </li>
        </ul>
        <!-- responisve navbar -->
        <div class="flex md:hidden items-center justify-center relative">
            <figure>
                <img src="<?php echo $url ?>/asset/menu.svg" alt="" id="menu" class="w-12">
                <img src="<?php echo $url ?>/asset/close.svg" alt="" id="close" class="w-12 hidden">
            </figure>
            <div id="navbar" class="nav-transiotion absolute top-[20%] right-[-2px] opacity-5">
                <ul
                    class="w-[200px] flex flex-col items-center justify-center shadow-md border-gray-300 rounded-md border-[1px] ">
                    <li class="p-4 bg-white text-black font-medium w-full border-b-[1px] border-gray-400 rounded-t-md">
                        <a href="<?php echo $url ?>/questionbank"">Question Bank</a>
                    </li>
                    <li class=" p-4 bg-white text-black font-medium w-full border-b-[1px] border-gray-400">
                            <a href="<?php echo $url ?>/exam"">Exam</a>
                    </li>
                    <li class=" p-4 bg-white text-black font-medium w-full border-b-[1px] border-gray-400">
                                <a href="<?php echo $url ?>/blog">Blogs</a>
                    </li>
                    <li class=" p-4 bg-white text-black font-medium w-full border-b-[1px] border-gray-400
                                rounded-b-md">
                        <a href="<?php echo $url ?>/settings">Settings & Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="fixed bottom-[20px] right-[40px] w-10 h-10 bg-black/30 rounded-md items-center justify-center transition-opacity duration-500 opacity-0 flex cursor-pointer"
    id="scroll-top">
    <img src="<?php echo $url ?>/asset/icons/arrow-up.svg" alt="">
</div>