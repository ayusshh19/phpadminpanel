<div class="md:ml-[30%] xl:ml-[20%] flex justify-center items-center">
    <div class="m-10 xl:w-1/3">
        <div class="rounded-lg border bg-white px-4 pt-8 pb-10 shadow-lg">
            <div class="relative mx-auto w-36 rounded-full">
                <span
                    class="absolute right-0 m-3 h-3 w-3 rounded-full bg-green-500 ring-2 ring-green-300 ring-offset-2"></span>
                <img class="mx-auto h-auto w-full rounded-full"
                    src="../public/uploads/<?php echo $_SESSION["user"]["profile_photo"]; ?>" alt="" />
            </div>
            <h1 class="my-1 text-center text-xl font-bold leading-8 text-gray-900">
                <?php echo $_SESSION["user"]["name"]; ?>
            </h1>
            <h3 class="font-lg text-semibold text-center leading-6 text-gray-600">
                <?php echo $_SESSION["user"]["email"]; ?>
            </h3>
            <p class="text-center text-sm leading-6 text-gray-500 hover:text-gray-600"><?php echo $translated["companyname"] ?></p>
            <ul
                class="mt-3 divide-y rounded bg-gray-100 py-2 px-3 text-gray-600 shadow-sm hover:text-gray-700 hover:shadow">
                <li class="flex items-center py-3 text-sm">
                    <span><?php echo $translated["userstatus"] ?></span>
                    <span class="ml-auto"><span
                            class="rounded-full bg-green-200 py-1 px-2 text-xs font-medium text-green-700"><?php echo $_SESSION["user"]["status"] ?></span></span>
                </li>
                <li class="flex items-center py-3 text-sm">
                    <span><?php echo $translated["lastlogin"] ?></span>
                    <span class="ml-auto"><?php echo $_SESSION["user"]["last_login"] ?></span>
                </li>
            </ul>
        </div>
    </div>

</div>