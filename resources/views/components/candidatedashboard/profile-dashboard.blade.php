<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>

<body>
    <div id="loader" class="LoadingOverlay hidden">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>
</body>

</html>

<div class="p-4 sm:ml-64 bg-slate-100">
    <div class="p-4 border-2 border-blue-400 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-8 border-b border-blue-500">
            <h2 class="text-3xl font-semibold">Candidate Dashboard</h2>

        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl text-red-900 font-semibold">Candidate Profiles</h3>
        </div>
        <div class="flex justify-end mb-3">
            <button class="bg-green-700 hover:bg-green-500 py-1 px-2 text-base text-white font-medium rounded-lg mr-3"
                id="previewBtn">Preview</button>
            <button class="bg-green-700 hover:bg-green-500 py-1 px-2 text-base text-white font-medium rounded-lg mr-3"
                id="createProfileBtn">Create Profile</button>
            <button class="bg-blue-700 hover:bg-green-500 py-1 px-2 text-base text-white font-medium rounded-lg"
                id="saveBtn">Save</button>
        </div>
        <div class="bg-zinc-200 rounded-lg p-3 mb-4">
            <h3 class="text-2xl text-blue-800 mb-3 font-medium">General Information</h3>
            <div class="mb-3">

                <label for="fullName" class="mr-8">Full Name: <span class="text-red-700 text-lg">*</span></label>
                <input type="text" id="fullName" name="fullName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-3">
                <label for="fatherName" class="mr-3">Father Name: <span class="text-red-700 text-lg">*</span></label>
                <input type="text" id="fatherName" name="fatherName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="motherName" class="mr-3">Mother Name: <span class="text-red-700 text-lg">*</span></label>
                <input type="text" id="motherName" name="motherName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="dob" class="mr-3">Date of Birth: <span class="text-red-700 text-lg">*</span></label>
                <input type="date" id="dob" name="dob"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="bloodgroup" class="mr-3">Blood Group:</label>
                <input type="text" id="bloodgroup" name="bloodgroup"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="candidatenid" class="mr-3">NID: <span class="text-red-700 text-lg">*</span></label>
                <input type="text" id="candidatenid" name="candidatenid"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="passportNo" class="mr-3">Passport No:</label>
                <input type="text" id="passportNo" name="passportNo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="cellphone" class="mr-3">Cell Phone: <span class="text-red-700 text-lg">*</span></label>
                <input type="text" id="cellphone" name="cellphone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="emergencycellphone" class="mr-3">Emergency Cell Phone: <span
                        class="text-red-700 text-lg">*</span></label>
                <input type="text" id="emergencycellphone" name="emergencycellphone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="candidateemail" class="mr-3">Email: <span class="text-red-700 text-lg">*</span></label>
                <input type="text" id="candidateemail" name="candidateemail"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="whatsapp" class="mr-3">What's App No:</label>
                <input type="text" id="whatsapp" name="whatsapp"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-3">
                <label for="linkedin" class="mr-3">LinkedIn Link: <span
                        class="text-red-700 text-lg">*</span></label>
                <input type="text" id="linkedin" name="linkedin"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="fblink" class="mr-3">Facebook Link:</label>
                <input type="text" id="fblink" name="fblink"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="githublink" class="mr-3">Github Link:</label>
                <input type="text" id="githublink" name="githublink"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="behancelink" class="mr-3">Behance / Dribble Link:</label>
                <input type="text" id="behancelink" name="behancelink"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-3">
                <label for="portfolio" class="mr-3">Portfolio Website:</label>
                <input type="text" id="portfolio" name="portfolio"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

        </div>

        <div class="bg-zinc-200 rounded-lg p-3 mb-4">
            <h3 class="text-2xl text-blue-800 mb-3 font-medium">Educational Information</h3>

            <div class="flex justify-between mb-4">

                <div>
                    <label for="degreetype1" class="text-center">Degree Type</label>
                    <input type="text" id="degreetype1" name="degreetype1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="universityname" class="text-center">University Name</label>
                    <input type="text" id="universityname" name="universityname"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="department1" class="text-center">Department</label>
                    <input type="text" id="department1" name="department1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="passyear1" class="text-center">Passing Year</label>
                    <input type="text" id="passyear1" name="passyear1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="result1" class="text-center">Result</label>
                    <input type="text" id="result1" name="result1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </div>
            <div class="flex justify-between mb-4">

                <div>
                    <label for="degreetype2" class="text-center">Degree Type</label>
                    <input type="text" id="degreetype2" name="degreetype2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="collegename" class="text-center">College Name</label>
                    <input type="text" id="collegename" name="collegename"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="department2" class="text-center">Group</label>
                    <input type="text" id="department2" name="department2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="passyear2" class="text-center">Passing Year</label>
                    <input type="text" id="passyear2" name="passyear2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="result2" class="text-center">Result</label>
                    <input type="text" id="result2" name="result2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </div>
            <div class="flex justify-between mb-4">

                <div>
                    <label for="degreetype3" class="text-center">Degree Type</label>
                    <input type="text" id="degreetype3" name="degreetype3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="schoolname" class="text-center">School Name</label>
                    <input type="text" id="schoolname" name="schoolname"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="department3" class="text-center">Group</label>
                    <input type="text" id="department3" name="department3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="passyear3" class="text-center">Passing Year</label>
                    <input type="text" id="passyear3" name="passyear3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="result3" class="text-center">Result</label>
                    <input type="text" id="result3" name="result3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </div>

        </div>


        <div class="bg-zinc-200 rounded-lg p-3 mb-4">
            <h3 class="text-2xl text-blue-800 mb-3 font-medium">Professional Training (If Any)</h3>

            <div class="flex justify-between mb-4">

                <div>
                    <label for="training1" class="text-center">Training Name</label>
                    <input type="text" id="training1" name="training1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="institution1" class="text-center">Institution Name</label>
                    <input type="text" id="institution1" name="institution1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="completion1" class="text-center">Completion Year</label>
                    <input type="text" id="completion1" name="completion1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

            </div>
            <div class="flex justify-between mb-4">

                <div>
                    <label for="training2" class="text-center">Training Name</label>
                    <input type="text" id="training2" name="training2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="institution2" class="text-center">Institution Name</label>
                    <input type="text" id="institution2" name="institution2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="completion2" class="text-center">Completion Year</label>
                    <input type="text" id="completion2" name="completion2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

            </div>
            <div class="flex justify-between mb-4">

                <div>
                    <label for="training3" class="text-center">Training Name</label>
                    <input type="text" id="training3" name="training3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="institution3" class="text-center">Institution Name</label>
                    <input type="text" id="institution3" name="institution3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="completion3" class="text-center">Completion Year</label>
                    <input type="text" id="completion3" name="completion3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

            </div>


        </div>

        <div class="bg-zinc-200 rounded-lg p-3 mb-4">
            <h3 class="text-2xl text-blue-800 mb-3 font-medium">Job Experience (If Any)</h3>

            <div class="flex justify-between mb-4">

                <div>
                    <label for="designation1" class="text-center">Designation</label>
                    <input type="text" id="designation1" name="designation1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="company1" class="text-center">Company Name</label>
                    <input type="text" id="company1" name="company1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="joindate1" class="text-center">Join Date</label>
                    <input type="date" id="joindate1" name="joindate1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="leavedate1" class="text-center">Leave Date</label>
                    <input type="date" id="leavedate1" name="leavedate1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:" />
                    <input type="checkbox" name="" id="currentlyWorking">
                    <label for="currentlyWorking">Currently Working</label>
                </div>

            </div>


            <div class="flex justify-between mb-4">

                <div>
                    <label for="designation2" class="text-center">Designation</label>
                    <input type="text" id="designation2" name="designation2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="company2" class="text-center">Company Name</label>
                    <input type="text" id="company2" name="company2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="joindate2" class="text-center">Join Date</label>
                    <input type="date" id="joindate2" name="joindate2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="leavedate2" class="text-center">Leave Date</label>
                    <input type="date" id="leavedate2" name="leavedate2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

            </div>


            <div class="flex justify-between mb-4">

                <div>
                    <label for="designation3" class="text-center">Designation</label>
                    <input type="text" id="designation3" name="designation3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="company3" class="text-center">Company Name</label>
                    <input type="text" id="company3" name="company3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="joindate3" class="text-center">Join Date</label>
                    <input type="date" id="joindate3" name="joindate3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="leavedate3" class="text-center">Leave Date</label>
                    <input type="date" id="leavedate3" name="leavedate3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

            </div>



        </div>


        <div class="bg-zinc-200 rounded-lg p-3 mb-4">
            <h3 class="text-2xl text-blue-800 mb-3 font-medium">Skills (Use Comma after Every skill)</h3>
            <textarea id="skills" name="skills" rows="4"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> </textarea>
        </div>

        <div class="bg-zinc-200 rounded-lg p-3 text-center">
            <h3 class="text-2xl text-blue-800 mb-3 font-medium">Extra Information</h3>
            <div class="mb-2">
                <label for="currentsalary" class="text-center">Current Salary: </label>
                <input type="text" id="currentsalary" name="currentsalary"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div>
                <label for="expectedsalary" class="text-center">Expected Salary: <span
                        class="text-red-700 text-lg">*</span></label>
                <input type="text" id="expectedsalary" name="expectedsalary"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
        </div>


    </div>
</div>

{{-- Preview Modal of Candidate Details --}}
<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="previewModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-11/12 h-[90%] mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModalView" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Candidate Detail Informations</ins></p>
                    <div class="border p-2 rounded-lg mb-3 w-3/4">
                        <h3 class="text-2xl text-yellow-300 mb-3">General Information</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <div class="flex justify-center"> <img src="" alt="no image" class="w-28 h-24"
                                    id=candidateImg></div>
                            <div class="">
                                <p class="text-left text-base font-medium mb-2">Full Name: <span
                                        class="text-md text-purple-600 ml-3 p-1 w-auto" id="fullName1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Father's Name: <span
                                        class="text-md text-purple-600 ml-3" id="fatherName1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Mother's Name: <span
                                        class="text-md text-purple-600 ml-3" id="motherName1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Date of Birth: <span
                                        class="text-md text-purple-600 ml-3" id="dateOfBirth1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Blood Group: <span
                                        class="text-md text-purple-600 ml-3" id="bloodGroup1"></span></p>
                                <p class="text-left text-base font-medium mb-2">SocialID/NID: <span
                                        class="text-md text-purple-600 ml-3" id="nID1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Passport No: <span
                                        class="text-md text-purple-600 ml-3" id="passportNo1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Cellphone No: <span
                                        class="text-md text-purple-600 ml-3" id="cellPhoneNo1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Emergency Contact No: <span
                                        class="text-md text-purple-600 ml-3" id="emergencyNo1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Email: <span
                                        class="text-md text-purple-600 ml-3" id="emailAddress1"></span></p>
                                <p class="text-left text-base font-medium mb-2">What's App: <span
                                        class="text-md text-purple-600 ml-3" id="whatsApp1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Linkdein Link: <span
                                        class="text-md text-purple-600 ml-3" id="linkedinLink1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Facebook Link: <span
                                        class="text-md text-purple-600 ml-3" id="fbLink1"></span></p>
                                <p class="text-left text-base font-medium mb-2">GitHub Link: <span
                                        class="text-md text-purple-600 ml-3" id="githubLink1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Behance/Dribble Link: <span
                                        class="text-md text-purple-600 ml-3" id="behanceLink1"></span></p>
                                <p class="text-left text-base font-medium mb-2">Porfolio Website: <span
                                        class="text-md text-purple-600 ml-3" id="portfolioLink1"></span></p>
                            </div>

                        </div>

                    </div>
                    <div class="border p-2 rounded-lg w-3/4 mb-3">
                        <h3 class="text-2xl text-yellow-300 mb-3">Educational Information</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <table class="w-full">
                                <thead>
                                    <tr class="border">
                                        <th class="px-4 py-2 text-left">Degree Type</th>
                                        <th class="px-4 py-2 text-center">University / Institution Name</th>
                                        <th class="px-4 py-2 text-center">Department / Group</th>
                                        <th class="px-4 py-2 text-center">Passing Year</th>
                                        <th class="px-4 py-2 text-center">CGPA/GPA</th>
                                    </tr>
                                </thead>
                                <tbody id="educationDetails">

                                </tbody>

                            </table>

                        </div>

                    </div>
                    <div class="border p-2 rounded-lg w-3/4 mb-3">
                        <h3 class="text-2xl text-yellow-300 mb-3">Professional Trainings</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <table class="w-full">
                                <thead>
                                    <tr class="border">
                                        <th class="px-4 py-2 text-left">Training Name</th>
                                        <th class="px-4 py-2 text-center">Institution Name</th>
                                        <th class="px-4 py-2 text-center">Completion Year</th>
                                    </tr>
                                </thead>
                                <tbody id="trainingDetails">

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <div class="border p-2 rounded-lg w-3/4 mb-3">
                        <h3 class="text-2xl text-yellow-300 mb-3">Job Experiences</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <table class="w-full">
                                <thead>
                                    <tr class="border">
                                        <th class="px-4 py-2 text-left">Designation</th>
                                        <th class="px-4 py-2 text-center">Company Name</th>
                                        <th class="px-4 py-2 text-center">Joining Date</th>
                                        <th class="px-4 py-2 text-center">Deperture Date</th>
                                    </tr>
                                </thead>
                                <tbody id="experienceDetails">

                                </tbody>

                            </table>

                        </div>

                    </div>
                    <div class="border p-2 rounded-lg w-3/4 mb-3">
                        <h3 class="text-2xl text-yellow-300 mb-3">Skills</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <div id="skillsDetails"></div>
                        </div>
                    </div>

                    <div class="border p-2 rounded-lg w-3/4">
                        <h3 class="text-2xl text-yellow-300 mb-3">Extra Information</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <div id="extraInfo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('createProfileBtn').addEventListener('click', () => {

        //General Information

        const fullName = document.getElementById('fullName').value;
        const fatherName = document.getElementById('fatherName').value;
        const motherName = document.getElementById('motherName').value;
        const dob = document.getElementById('dob').value;
        const bloodgroup = document.getElementById('bloodgroup').value;
        const candidatenid = document.getElementById('candidatenid').value;

        const passportNo = document.getElementById('passportNo').value;
        const cellphone = document.getElementById('cellphone').value;
        const emergencycellphone = document.getElementById('emergencycellphone').value;
        const candidateemail = document.getElementById('candidateemail').value;
        const whatsapp = document.getElementById('whatsapp').value;
        const linkedin = document.getElementById('linkedin').value;
        const fblink = document.getElementById('fblink').value;
        const githublink = document.getElementById('githublink').value;
        const behancelink = document.getElementById('behancelink').value;
        const portfolio = document.getElementById('portfolio').value;

        // Education Information

        const degreetype1 = document.getElementById('degreetype1').value;
        const universityname = document.getElementById('universityname').value;
        const department1 = document.getElementById('department1').value;
        const passyear1 = document.getElementById('passyear1').value;
        const result1 = document.getElementById('result1').value;


        const degreetype2 = document.getElementById('degreetype2').value;
        const collegename = document.getElementById('collegename').value;
        const department2 = document.getElementById('department2').value;
        const passyear2 = document.getElementById('passyear2').value;
        const result2 = document.getElementById('result2').value;


        const degreetype3 = document.getElementById('degreetype3').value;
        const schoolname = document.getElementById('schoolname').value;
        const department3 = document.getElementById('department3').value;
        const passyear3 = document.getElementById('passyear3').value;
        const result3 = document.getElementById('result3').value;



        //Training Informaton

        const training1 = document.getElementById('training1').value;
        const institution1 = document.getElementById('institution1').value;
        const completion1 = document.getElementById('completion1').value;


        const training2 = document.getElementById('training2').value;
        const institution2 = document.getElementById('institution2').value;
        const completion2 = document.getElementById('completion2').value;


        const training3 = document.getElementById('training3').value;
        const institution3 = document.getElementById('institution3').value;
        const completion3 = document.getElementById('completion3').value;




        // Job Experience

        const designation1 = document.getElementById('designation1').value;
        const company1 = document.getElementById('company1').value;
        const joindate1 = document.getElementById('joindate1').value;
        const leavedate1 = document.getElementById('leavedate1').value;
        const currentlyWorking = document.getElementById('currentlyWorking');




        const designation2 = document.getElementById('designation2').value;
        const company2 = document.getElementById('company2').value;
        const joindate2 = document.getElementById('joindate2').value;
        const leavedate2 = document.getElementById('leavedate2').value;



        const designation3 = document.getElementById('designation3').value;
        const company3 = document.getElementById('company3').value;
        const joindate3 = document.getElementById('joindate3').value;
        const leavedate3 = document.getElementById('leavedate3').value;



        // skills

        const skills = document.getElementById('skills').value;

        // Extra Info

        const currentsalary = document.getElementById('currentsalary').value;
        const expectedsalary = document.getElementById('expectedsalary').value;



        const formData = new FormData();
        formData.append('full_name', fullName);
        formData.append('father_name', fatherName);
        formData.append('mother_name', motherName);
        formData.append('date_of_birth', dob);
        formData.append('blood_group', bloodgroup);
        formData.append('nid', candidatenid);
        formData.append('passport_no', passportNo);
        formData.append('cellphone_no', cellphone);
        formData.append('emergency_contact_no', emergencycellphone);
        formData.append('email', candidateemail);
        formData.append('whatsapp_no', whatsapp);
        formData.append('linkedin_link', linkedin);
        formData.append('fb_id', fblink);
        formData.append('github_link', githublink);
        formData.append('behance_or_dribble_link', behancelink);
        formData.append('portfolio_link', portfolio);


        formData.append('degree_type_1', degreetype1);
        formData.append('education_institution_1', universityname);
        formData.append('department_1', department1);
        formData.append('passing_year_1', passyear1);
        formData.append('result_1', result1);

        formData.append('degree_type_2', degreetype2);
        formData.append('education_institution_2', collegename);
        formData.append('department_2', department2);
        formData.append('passing_year_2', passyear2);
        formData.append('result_2', result2);

        formData.append('degree_type_3', degreetype3);
        formData.append('education_institution_3', schoolname);
        formData.append('department_3', department3);
        formData.append('passing_year_3', passyear3);
        formData.append('result_3', result3);


        formData.append('training_name_1', training1);
        formData.append('training_institution_1', institution1);
        formData.append('completion_year_1', completion1);

        formData.append('training_name_2', training2);
        formData.append('training_institution_2', institution2);
        formData.append('completion_year_2', completion2);

        formData.append('training_name_3', training3);
        formData.append('training_institution_3', institution3);
        formData.append('completion_year_3', completion3);



        formData.append('designation1', designation1);
        formData.append('company_name1', company1);
        formData.append('join_date1', joindate1);
        formData.append('deperture_date1', leavedate1);

        formData.append('designation2', designation2);
        formData.append('company_name2', company2);
        formData.append('join_date2', joindate2);
        formData.append('deperture_date2', leavedate2);

        formData.append('designation3', designation3);
        formData.append('company_name3', company3);
        formData.append('join_date3', joindate3);
        formData.append('deperture_date3', leavedate3);


        formData.append('skills', skills);


        formData.append('current_salary', currentsalary);
        formData.append('expected_salary', expectedsalary);

        create(formData);
    })

    async function create(formData) {
        showLoader();
        let res = await axios.post('/dashboard/candidate/createBasicInfo', formData);
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }


    }



    document.getElementById('saveBtn').addEventListener('click', () => {

        //General Information

        const fullName = document.getElementById('fullName').value;
        const fatherName = document.getElementById('fatherName').value;
        const motherName = document.getElementById('motherName').value;
        const dob = document.getElementById('dob').value;
        const bloodgroup = document.getElementById('bloodgroup').value;
        const candidatenid = document.getElementById('candidatenid').value;

        const passportNo = document.getElementById('passportNo').value;
        const cellphone = document.getElementById('cellphone').value;
        const emergencycellphone = document.getElementById('emergencycellphone').value;
        const candidateemail = document.getElementById('candidateemail').value;
        const whatsapp = document.getElementById('whatsapp').value;
        const linkedin = document.getElementById('linkedin').value;
        const fblink = document.getElementById('fblink').value;
        const githublink = document.getElementById('githublink').value;
        const behancelink = document.getElementById('behancelink').value;
        const portfolio = document.getElementById('portfolio').value;

        // Education Information

        const degreetype1 = document.getElementById('degreetype1').value;
        const universityname = document.getElementById('universityname').value;
        const department1 = document.getElementById('department1').value;
        const passyear1 = document.getElementById('passyear1').value;
        const result1 = document.getElementById('result1').value;


        const degreetype2 = document.getElementById('degreetype2').value;
        const collegename = document.getElementById('collegename').value;
        const department2 = document.getElementById('department2').value;
        const passyear2 = document.getElementById('passyear2').value;
        const result2 = document.getElementById('result2').value;


        const degreetype3 = document.getElementById('degreetype3').value;
        const schoolname = document.getElementById('schoolname').value;
        const department3 = document.getElementById('department3').value;
        const passyear3 = document.getElementById('passyear3').value;
        const result3 = document.getElementById('result3').value;



        //Training Informaton

        const training1 = document.getElementById('training1').value;
        const institution1 = document.getElementById('institution1').value;
        const completion1 = document.getElementById('completion1').value;


        const training2 = document.getElementById('training2').value;
        const institution2 = document.getElementById('institution2').value;
        const completion2 = document.getElementById('completion2').value;


        const training3 = document.getElementById('training3').value;
        const institution3 = document.getElementById('institution3').value;
        const completion3 = document.getElementById('completion3').value;




        // Job Experience

        const designation1 = document.getElementById('designation1').value;
        const company1 = document.getElementById('company1').value;
        const joindate1 = document.getElementById('joindate1').value;
        const leavedate1 = document.getElementById('leavedate1').value;
        const currentlyWorking = document.getElementById('currentlyWorking');




        const designation2 = document.getElementById('designation2').value;
        const company2 = document.getElementById('company2').value;
        const joindate2 = document.getElementById('joindate2').value;
        const leavedate2 = document.getElementById('leavedate2').value;



        const designation3 = document.getElementById('designation3').value;
        const company3 = document.getElementById('company3').value;
        const joindate3 = document.getElementById('joindate3').value;
        const leavedate3 = document.getElementById('leavedate3').value;



        // skills

        const skills = document.getElementById('skills').value;

        // Extra Info

        const currentsalary = document.getElementById('currentsalary').value;
        const expectedsalary = document.getElementById('expectedsalary').value;

        let generalId = document.getElementById('fullName').getAttribute('general-id');


        let degreeId1 = document.getElementById('degreetype1').getAttribute('degree1-id');
        let degreeId2 = document.getElementById('degreetype2').getAttribute('degree2-id');
        let degreeId3 = document.getElementById('degreetype3').getAttribute('degree3-id');


        let trainingId1 = document.getElementById('training1').getAttribute('training1-id');
        let trainingId2 = document.getElementById('training2').getAttribute('training2-id');
        let trainingId3 = document.getElementById('training3').getAttribute('training3-id');



        let designationId1 = document.getElementById('designation1').getAttribute('designation1-id');
        let designationId2 = document.getElementById('designation2').getAttribute('designation2-id');
        let designationId3 = document.getElementById('designation3').getAttribute('designation3-id');



        let skillsId = document.getElementById('skills').getAttribute('skills-id');




        const formData = new FormData();
        formData.append('general_id', generalId);
        formData.append('full_name', fullName);
        formData.append('father_name', fatherName);
        formData.append('mother_name', motherName);
        formData.append('date_of_birth', dob);
        formData.append('blood_group', bloodgroup);
        formData.append('nid', candidatenid);
        formData.append('passport_no', passportNo);
        formData.append('cellphone_no', cellphone);
        formData.append('emergency_contact_no', emergencycellphone);
        formData.append('email', candidateemail);
        formData.append('whatsapp_no', whatsapp);
        formData.append('linkedin_link', linkedin);
        formData.append('fb_id', fblink);
        formData.append('github_link', githublink);
        formData.append('behance_or_dribble_link', behancelink);
        formData.append('portfolio_link', portfolio);


        //Education part
        formData.append('degree_id_1', degreeId1);
        formData.append('degree_type_1', degreetype1);
        formData.append('education_institution_1', universityname);
        formData.append('department_1', department1);
        formData.append('passing_year_1', passyear1);
        formData.append('result_1', result1);



        formData.append('degree_id_2', degreeId2);
        formData.append('degree_type_2', degreetype2);
        formData.append('education_institution_2', collegename);
        formData.append('department_2', department2);
        formData.append('passing_year_2', passyear2);
        formData.append('result_2', result2);



        formData.append('degree_id_3', degreeId3);
        formData.append('degree_type_3', degreetype3);
        formData.append('education_institution_3', schoolname);
        formData.append('department_3', department3);
        formData.append('passing_year_3', passyear3);
        formData.append('result_3', result3);


        //Training part
        formData.append('training_id_1', trainingId1);
        formData.append('training_name_1', training1);
        formData.append('training_institution_1', institution1);
        formData.append('completion_year_1', completion1);



        formData.append('training_id_2', trainingId2);
        formData.append('training_name_2', training2);
        formData.append('training_institution_2', institution2);
        formData.append('completion_year_2', completion2);



        formData.append('training_id_3', trainingId3);
        formData.append('training_name_3', training3);
        formData.append('training_institution_3', institution3);
        formData.append('completion_year_3', completion3);


        //Expericence part
        formData.append('designation_id_1', designationId1);
        formData.append('designation1', designation1);
        formData.append('company_name1', company1);
        formData.append('join_date1', joindate1);
        formData.append('deperture_date1', leavedate1);


        formData.append('designation_id_2', designationId2);
        formData.append('designation2', designation2);
        formData.append('company_name2', company2);
        formData.append('join_date2', joindate2);
        formData.append('deperture_date2', leavedate2);


        formData.append('designation_id_3', designationId3);
        formData.append('designation3', designation3);
        formData.append('company_name3', company3);
        formData.append('join_date3', joindate3);
        formData.append('deperture_date3', leavedate3);


        formData.append('skills_id', skillsId);
        formData.append('skills', skills);


        formData.append('current_salary', currentsalary);
        formData.append('expected_salary', expectedsalary);

        updateCandidateInfo(formData);
    })




    async function updateCandidateInfo(formData) {
        showLoader();
        let res = await axios.post('/dashboard/candidate/updateBasicInfo', formData);
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }


    }


    document.getElementById('currentlyWorking').addEventListener('click', () => {
        document.getElementById('leavedate1').disabled = true
        leavedate1.value = 'currently working';

    })


    async function getDetailInformation() {
        showLoader();
        let res = await axios.get('/dashboard/candidate/cvDetails');
        hideLoader();



        if (res.data.basicData.length === 0) {
            document.getElementById('previewBtn').classList.add('hidden')
            document.getElementById('saveBtn').classList.add('hidden')
        } else {
            document.getElementById('createProfileBtn').classList.add('hidden')
        }

        //General Information

        res.data.basicData.map(item => {
            fullName.setAttribute('general-id', item.id);
            fullName.value = item.full_name;
            fatherName.value = item.father_name;
            motherName.value = item.mother_name;
            dob.value = item.date_of_birth;
            bloodgroup.value = item.blood_group;
            candidatenid.value = item.nid;
            passportNo.value = item.passport_no;
            cellphone.value = item.cellphone_no;
            emergencycellphone.value = item.emergency_contact_no;
            candidateemail.value = item.email;
            whatsapp.value = item.whatsapp_no;
            linkedin.value = item.linkedin_link;
            fblink.value = item.fb_id;
            githublink.value = item.github_link;
            behancelink.value = item.behance_or_dribble_link;
            portfolio.value = item.portfolio_link;
        })


        //Education Details

        res.data.eduData.forEach(function(data, index) {
            switch (index) {
                case 0:
                    degreetype1.setAttribute('degree1-id', data.id);
                    degreetype1.value = data.degree_type;
                    universityname.value = data.education_institution;
                    department1.value = data.department;
                    passyear1.value = data.passing_year;
                    result1.value = data.result;
                    break;
                case 1:
                    degreetype2.setAttribute('degree2-id', data.id);
                    degreetype2.value = data.degree_type;
                    collegename.value = data.education_institution;
                    department2.value = data.department;
                    passyear2.value = data.passing_year;
                    result2.value = data.result;
                    break;
                case 2:
                    degreetype3.setAttribute('degree3-id', data.id);
                    degreetype3.value = data.degree_type;
                    schoolname.value = data.education_institution;
                    department3.value = data.department;
                    passyear3.value = data.passing_year;
                    result3.value = data.result;
                    break;
                default:
                    break;
            }
        })

        // Training Details

        res.data.traniningData.forEach(function(data, index) {
            switch (index) {
                case 0:
                    training1.setAttribute('training1-id', data.id);
                    training1.value = data.training_name;
                    institution1.value = data.training_institution;
                    completion1.value = data.completion_year;
                    break;
                case 1:
                    training2.setAttribute('training2-id', data.id);
                    training2.value = data.training_name;
                    institution2.value = data.training_institution;
                    completion2.value = data.completion_year;
                    break;
                case 2:
                    training3.setAttribute('training3-id', data.id);
                    training3.value = data.training_name;
                    institution3.value = data.training_institution;
                    completion3.value = data.completion_year;
                    break;

                default:
                    break;
            }
        })

        // Job Experience

        res.data.experienceData.forEach(function(data, index) {
            switch (index) {
                case 0:
                    designation1.setAttribute('designation1-id', data.id);
                    designation1.value = data.designation;
                    company1.value = data.company_name;
                    joindate1.value = data.join_date;
                    leavedate1.value = data.deperture_date;
                    break;
                case 1:
                    designation2.setAttribute('designation2-id', data.id);
                    designation2.value = data.designation;
                    company2.value = data.company_name;
                    joindate2.value = data.join_date;
                    leavedate2.value = data.deperture_date;
                    break;
                case 2:
                    designation3.setAttribute('designation3-id', data.id);
                    designation3.value = data.designation;
                    company3.value = data.company_name;
                    joindate3.value = data.join_date;
                    leavedate3.value = data.deperture_date;
                    break;

                default:
                    break;
            }
        })

        res.data.skillData.forEach(function(item) {
            skills.setAttribute('skills-id', item.id);
            skills.value = item.skills;
            currentsalary.value = item.current_salary;
            expectedsalary.value = item.expected_salary;
        })




    }
    getDetailInformation();

    document.getElementById('previewBtn').addEventListener('click', async () => {

        async function getCVDetails() {

            let res = await axios.get('/dashboard/candidate/cvDetails')
           
            // For candidate Image
            res.data.candidateImage.forEach(image => {

                document.getElementById('candidateImg').src =
                    `{{ asset('${image.image_url}') }}`

            });


            //For Candidate Basic Info

            res.data.basicData.forEach(item => {

                document.getElementById('fullName1').innerText = item
                    .full_name;
                document.getElementById('fatherName1').innerText = item
                    .father_name;
                document.getElementById('motherName1').innerText = item
                    .mother_name;
                document.getElementById('dateOfBirth1').innerText = item
                    .date_of_birth;
                document.getElementById('bloodGroup1').innerText = item
                    .blood_group;
                document.getElementById('nID1').innerText = item.nid;
                document.getElementById('passportNo1').innerText = item
                    .passport_no;
                document.getElementById('cellPhoneNo1').innerText = item
                    .cellphone_no;
                document.getElementById('emergencyNo1').innerText = item
                    .emergency_contact_no;
                document.getElementById('emailAddress1').innerText = item
                    .email;
                document.getElementById('whatsApp1').innerText = item
                    .whatsapp_no;
                document.getElementById('linkedinLink1').innerText = item
                    .linkedin_link;
                document.getElementById('fbLink1').innerText = item.fb_id;
                document.getElementById('githubLink1').innerText = item
                    .github_link;
                document.getElementById('behanceLink1').innerText = item
                    .behance_or_dribble_link;
                document.getElementById('portfolioLink1').innerText = item
                    .portfolio_link;
            })

            //For Candidate Education Info

            const eduInfo = res.data.eduData.map(item => {

                return `<tr>
            <td class="border px-4 py-2 font-normal">${item.degree_type}</td>
            <td class="border px-4 py-2 font-normal">${item.education_institution}</td>
            <td class="border px-4 py-2 font-normal">${item.department}</td>
            <td class="border px-4 py-2 font-normal">${item.passing_year}</td>
            <td class="border px-4 py-2 font-normal">${item.result}</td>
            </tr>`

            }).join('')

            document.getElementById('educationDetails').innerHTML = eduInfo


            //For Candidate Training Info

            const trainingInfo = res.data.traniningData.map(item => {
                return `<tr>
            <td class="border px-4 py-2 font-normal">${item.training_name}</td>
            <td class="border px-4 py-2 font-normal">${item.training_institution}</td>
            <td class="border px-4 py-2 font-normal">${item.completion_year}</td>
            </tr>`
            }).join('')

            document.getElementById('trainingDetails').innerHTML = trainingInfo;


            //For Candidate Experience Info

            const experienceInfo = res.data.experienceData.map(item => {

                return `<tr>
            <td class="border px-4 py-2 font-normal">${item.designation}</td>
            <td class="border px-4 py-2 font-normal">${item.company_name}</td>
            <td class="border px-4 py-2 font-normal">${item.join_date}</td>
            <td class="border px-4 py-2 font-normal">${item.deperture_date}</td>
            </tr>`

            }).join('')

            document.getElementById('experienceDetails').innerHTML = experienceInfo;


            // For Candidate Skill Info

            const skillsInfo = res.data.skillData.map(item => {

                return `<p class="font-medium">${item.skills}</p>`

            })

            document.getElementById('skillsDetails').innerHTML = skillsInfo


            // For Candidate Extra Info

            const extraInfo = res.data.skillData.map(item => {

                return `<p class="text-base font-medium">Current Salary: <span>${item.current_salary} /-</span></p>
        <p class="text-base font-medium">Expected Salary: <span>${item.expected_salary} /-</span></p>`

            })

            document.getElementById('extraInfo').innerHTML = extraInfo

        }

        getCVDetails();

        document.getElementById('previewModal').classList.remove('hidden');
        
    });
    
    document.getElementById('closeModalView').addEventListener('click',()=>{
        document.getElementById('previewModal').classList.add('hidden');

    })
</script>
