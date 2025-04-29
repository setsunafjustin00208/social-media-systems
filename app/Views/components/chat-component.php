<!-- filepath: c:\xampp_8\htdocs\social-forum-systems\app\Views\components\chat-componet.php -->
<div class="chat-component" id="chat-componet" x-data="{ activeTab: 'personal' }">
    <!-- Header -->
    <div class="chat-header">
        <button 
            class="button is-small" 
            :class="{ 'is-active': activeTab === 'personal' }" 
            @click="activeTab = 'personal'; $('#chat-componet').trigger('tabChange', 'personal')"
        >
            Personal Messages
        </button>
        <button 
            class="button is-small" 
            :class="{ 'is-active': activeTab === 'group' }" 
            @click="activeTab = 'group'; $('#chat-componet').trigger('tabChange', 'group')"
        >
            Group Chats
        </button>
    </div>

    <!-- Chat List -->
    <div class="chat-list">
        <!-- Personal Messages -->
        <ul x-show="activeTab === 'personal'" class="chat-tab">
            <li class="chat-item">
                <a href="#">
                    <span class="icon is-small">
                        <i class="fas fa-user-circle"></i>
                    </span>
                    <span class="ml-2 chat-name">John Doe</span>
                    <span class="chat-status is-online"></span>
                </a>
            </li>
            <li class="chat-item">
                <a href="#">
                    <span class="icon is-small">
                        <i class="fas fa-user-circle"></i>
                    </span>
                    <span class="ml-2 chat-name">Jane Smith</span>
                    <span class="chat-status is-offline"></span>
                </a>
            </li>
        </ul>

        <!-- Group Chats -->
        <ul x-show="activeTab === 'group'" class="chat-tab">
            <li class="chat-item">
                <a href="#">
                    <span class="icon is-small">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="ml-2 chat-name">Family Group</span>
                </a>
            </li>
            <li class="chat-item">
                <a href="#">
                    <span class="icon is-small">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="ml-2 chat-name">Work Team</span>
                </a>
            </li>
        </ul>
    </div>
</div>