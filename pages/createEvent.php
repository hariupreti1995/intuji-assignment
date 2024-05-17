<?php
$inputTextStyle = "bg-slate-200 p-2 focus:border-none outline-none rounded-md w-full mt-1.5";
$labelStyle = "text-gray-600 text-sm";
$errors = isset($_GET["errors"]) ? unserialize($_GET["errors"]) : [];
$formData = isset($_GET["data"]) ? unserialize($_GET["data"]) : [];
?>
<style>
    @keyframes shake {
        0% {
            transform: translateX(0)
        }

        25% {
            transform: translateX(5px)
        }

        50% {
            transform: translateX(-5px)
        }

        75% {
            transform: translateX(5px)
        }

        100% {
            transform: translateX(0)
        }
    }
</style>
<div class="flex-1 p-6">
    <div class="grid gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-lg font-semibold pb-4">Create new event</h3>
            <div class="text-[11px] text-gray-400 mx-4 mb-6">All fileds marked with an asterisk (*) are required</div>
            <form method="post" action="event/newevent.php">
                <div class="grid grid-flow-cols grid-cols-2">
                    <div class="mx-4">
                        <div>
                            <label class="<?php echo $labelStyle; ?>">Event Name <span
                                    class="font-semibold text-red-500">*</span></label>
                        </div>
                        <input type="text" name="name"
                            value="<?php echo !empty($formData) && key_exists("name", $formData) ? $formData["name"] : "" ?>"
                            placeholder="Name of event" class="<?php echo $inputTextStyle; ?>" />
                        <?php if (!empty($errors) && key_exists("name", $errors)) { ?>
                            <span class="flex text-red-500 my-1 rounded-md text-sm animate-[shake_1s]">
                                <?php echo $errors["name"]; ?></span>
                        <?php } ?>
                    </div>
                    <div class="mx-4">
                        <div><label class="<?php echo $labelStyle; ?>">Short Description <span
                                    class="font-semibold text-red-500">*</span></label></div>
                        <textarea name="description" placeholder="Short description"
                            class="<?php echo $inputTextStyle; ?>"><?php echo !empty($formData) && key_exists("description", $formData) ? $formData["description"] : "" ?></textarea>
                        <?php if (!empty($errors) && key_exists("description", $errors)) { ?>
                            <span class="flex text-red-500 my-1 rounded-md text-sm animate-[shake_1s]">
                                <?php echo $errors["description"]; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="grid grid-flow-cols grid-cols-3">
                    <div class="mx-4 my-8">
                        <div><label class="<?php echo $labelStyle; ?>">Event Location </label></div>
                        <input type="text" name="location" class="<?php echo $inputTextStyle; ?>"
                            value="<?php echo !empty($formData) && key_exists("location", $formData) ? $formData["location"] : "" ?>" />
                        <?php if (!empty($errors) && key_exists("location", $errors)) { ?>
                            <span class="flex text-red-500 my-1 rounded-md text-sm animate-[shake_1s]">
                                <?php echo $errors["location"]; ?></span>
                        <?php } ?>
                    </div>
                    <div class="mx-4 my-8">
                        <div><label class="<?php echo $labelStyle; ?>">Event Date <span
                                    class="font-semibold text-red-500">*</span></label></div>
                        <input type="date" name="date" class="<?php echo $inputTextStyle; ?>"
                            value="<?php echo !empty($formData) && key_exists("date", $formData) ? $formData["date"] : date("Y-m-d") ?>">
                        <?php if (!empty($errors) && key_exists("date", $errors)) { ?>
                            <span class="flex text-red-500 my-1 rounded-md text-sm animate-[shake_1s]">
                                <?php echo $errors["date"]; ?></span>
                        <?php } ?>
                    </div>
                    <div class="mx-4 my-8 grid grid-flow-cols grid-cols-2 gap-6">
                        <div>
                            <div><label class="<?php echo $labelStyle; ?>">Start Time <span
                                        class="font-semibold text-red-500">*</span></label></div>
                            <input type="time" name="time_from" class="<?php echo $inputTextStyle; ?>"
                                value="<?php echo !empty($formData) && key_exists("time_from", $formData) ? $formData["time_from"] : date("Y-m-d H:i:s") ?>">
                            <?php if (!empty($errors) && key_exists("time_from", $errors)) { ?>
                                <span class="flex text-red-500 my-1 rounded-md text-sm animate-[shake_1s]">
                                    <?php echo $errors["time_from"]; ?></span>
                            <?php } ?>
                        </div>
                        <div>
                            <div><label class="<?php echo $labelStyle; ?>">End Time <span
                                        class="font-semibold text-red-500">*</span></label></div>
                            <input type="time" name="time_to" class="<?php echo $inputTextStyle; ?>"
                                value="<?php echo !empty($formData) && key_exists("time_to", $formData) ? $formData["time_to"] : date("Y-m-d H:i:s") ?>">
                            <?php if (!empty($errors) && key_exists("time_to", $errors)) { ?>
                                <span class="flex text-red-500 my-1 rounded-md text-sm animate-[shake_1s]">
                                    <?php echo $errors["time_to"]; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>