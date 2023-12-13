<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            회원탈퇴
        </template>

        <template #description>
            계정을 탈퇴할 수 있습니다.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                계정이 삭제되면 해당 계정의 모든 리소스와 데이터가 영구적으로 삭제됩니다. 계정을 삭제하기 전에 보존하려는 데이터나 정보를 백업해 주세요.
            </div>

            <div class="mt-5">
                <DangerButton @click="confirmUserDeletion">
                    회원탈퇴
                </DangerButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    회원탈퇴
                </template>

                <template #content>
                    계정을 삭제하시겠습니까? 계정이 삭제되면 모든 리소스 및 데이터가 영구적으로 삭제됩니다. 계정을 영구적으로 삭제할지 확인하려면 암호를 입력하십시오.

                    <div class="mt-4">
                        <TextInput
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="비밀번호"
                            autocomplete="current-password"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        취소
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        회원탈퇴
                    </DangerButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
