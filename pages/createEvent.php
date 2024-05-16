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
                            value="<?php echo !empty($formData) && key_exists("description", $formData) ? $formData["description"] : "" ?>"
                            class="<?php echo $inputTextStyle; ?>"></textarea>
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
                        <div><label class="<?php echo $labelStyle; ?>">From Date <span
                                    class="font-semibold text-red-500">*</span></label></div>
                        <input type="datetime-local" name="from_date" class="<?php echo $inputTextStyle; ?>"
                        value="<?php echo !empty($formData) && key_exists("from_date", $formData) ? $formData["from_date"] : date("Y-m-d H:i:s") ?>" >
                        <?php if (!empty($errors) && key_exists("from_date", $errors)) { ?>
                            <span class="flex text-red-500 my-1 rounded-md text-sm animate-[shake_1s]">
                                <?php echo $errors["from_date"]; ?></span>
                        <?php } ?>
                    </div>
                    <div class="mx-4 my-8">
                        <div><label class="<?php echo $labelStyle; ?>">To Date <span
                                    class="font-semibold text-red-500">*</span></label></div>
                        <input type="datetime-local" name="to_date" class="<?php echo $inputTextStyle; ?>"
                        value="<?php echo !empty($formData) && key_exists("to_date", $formData) ? $formData["to_date"] : date("Y-m-d H:i:s") ?>">
                        <?php if (!empty($errors) && key_exists("to_date", $errors)) { ?>
                            <span class="flex text-red-500 my-1 rounded-md text-sm animate-[shake_1s]">
                                <?php echo $errors["to_date"]; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>