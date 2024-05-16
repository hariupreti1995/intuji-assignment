<?php
$inputTextStyle = "bg-slate-200 p-2 focus:border-none outline-none rounded-md w-full mt-1.5";
$labelStyle = "text-gray-600 text-sm";
?>
<div class="flex-1 p-6">
    <div class="grid gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-lg font-semibold pb-4">Create new event</h3>
            <form method="post" action="event/newevent.php">
                <div class="grid grid-flow-cols grid-cols-2">
                    <div class="mx-4">
                        <div><label class="<?php echo $labelStyle; ?>">Event Name</label></div>
                        <input type="text" name="name" placeholder="Name of event"
                            class="<?php echo $inputTextStyle; ?>" />
                    </div>
                    <div class="mx-4">
                        <div><label class="<?php echo $labelStyle; ?>">Short Description</label></div>
                        <textarea name="description" placeholder="Short description"
                            class="<?php echo $inputTextStyle; ?>"></textarea>
                    </div>
                    <div class="mx-4 my-8">
                        <div><label class="<?php echo $labelStyle; ?>">Event Location</label></div>
                        <input type="text" name="location" class="<?php echo $inputTextStyle; ?>" />
                    </div>
                    <div class="mx-4 my-8">
                        <div><label class="<?php echo $labelStyle; ?>">Date</label></div>
                        <input type="datetime-local" name="datetime" class="<?php echo $inputTextStyle; ?>"
                            value="<?php echo date("Y-m-d"); ?>">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>