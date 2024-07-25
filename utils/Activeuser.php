<?php
$result = $userobj->getAllactiveuser($lang);
?>
<div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5 w-full md:w-[42%]">
  <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900"><?php echo $translated["user"] ?></th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900"><?php echo $translated["lastlogin"] ?></th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
    <?php foreach ($result as $row): ?>
      <tr class="hover:bg-gray-50">
        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
          <div class="relative h-10 w-10">
            <img
              class="h-full w-full rounded-full object-cover object-center"
              src="../public/uploads/<?php echo htmlspecialchars($row["profile_photo"]); ?>"
              alt=""
            />
            <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
          </div>
          <div class="text-sm">
            <div class="font-medium text-gray-700"><?php echo htmlspecialchars($row["name"]) ?></div>
            <div class="text-gray-400"><?php echo htmlspecialchars($row["email"]) ?></div>
          </div>
        </th>
        <td class="px-6 py-4"><?php echo htmlspecialchars($row["last_login"]) ?></td>

      </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>