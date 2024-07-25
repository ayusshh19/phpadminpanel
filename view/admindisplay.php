<div class="md:ml-[30%] xl:ml-[20%]">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-slate-50 p-5 m-2 rounded-md flex justify-between items-center shadow">
                <div>
                    <h3 class="font-bold"><?php echo $translated["totalusers"]; ?></h3>
                    <p class="text-gray-500">100</p>
                </div>
                <i class="fa-solid fa-users p-4 bg-gray-200 rounded-md"></i>
            </div>

            <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                <div>
                    <h3 class="font-bold"><?php echo $translated["totalactiveusers"]; ?></h3>
                    <p class="text-gray-500">65</p>
                </div>
                <i class="fa-solid fa-users p-4 bg-green-200 rounded-md"></i>
            </div>

            <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                <div>
                    <h3 class="font-bold"><?php echo $translated["noupdatedusers"]; ?></h3>
                    <p class="text-gray-500">30</p>
                </div>
                <i class="fa-solid fa-users p-4 bg-yellow-200 rounded-md"></i>
            </div>

            <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                <div>
                    <h3 class="font-bold"><?php echo $translated["noupdatedusers"]; ?></h3>
                    <p class="text-gray-500">5</p>
                </div>
                <i class="fa-solid fa-users p-4 bg-red-200 rounded-md"></i>
            </div>
        </div>
        <div class="flex flex-wrap">
            <?php
                include ("../utils/Alluser.php");
                ?>
        </div>
        <?php include ("../utils/Activeuser.php"); ?>
    </div>