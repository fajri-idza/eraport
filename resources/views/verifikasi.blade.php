<x-volt-app title="Verifikasi">
    <x-volt-panel title="Informasi Umum">
        @if($kyc?->status === 'PENGAJUAN')
        <div class="ui steps">
            <a class="active step">
              <i class="user icon"></i>
              <div class="content">
                <div class="title">KYC</div>
                <div class="description">Pengajuan Formulir KYC</div>
              </div>
            </a>
            <a class="step">
                <i class="spinner icon"></i>
              <div class="content">
                <div class="title">VERIFIKASI</div>
                <div class="description">Data anda sedang di verifikasi dalam waktu 1x24 Jam, Silahkan hubungi support@transformasirumahdigital.com jika ada kendala.</div>
              </div>
            </a>
          </div>
        @else
        {!! form()->post(route('kyc.store'))->horizontal()->multipart()  !!}
            {!! form()->text('name')->label(__('Nama'))->required() !!}
            {!! form()->text('born')->label(__('Tempat Lahir'))->required() !!}
            {!! form()->date('born_date')->label(__('Tanggal Lahir'))->required() !!}
            {!! form()->text('no_identitas')->label(__('No Identitas'))->hint('KTP/SIM/PASSPOR')->required() !!}
            {!! form()->text('pekerjaan')->label(__('Pekerjaan'))->required() !!}
            {!!
                form()
                ->uploader('foto_identitas')
                ->limit(1) //optional, defaul to 1 (single file upload)
                ->extensions(['jpg', 'png'])
                ->fileMaxSize(2)
                ->label('Foto Kartu Identitas') // optional, default to null (all files allowed)
                ->hint('JPG/PNG')
                ->ajax(false)
                ->required()
              !!}
              {!! form()->textarea('alamat')->label('Alamat Rumah')->required() !!}
              {!! form()->text('no_hp')->label(__('No HP'))->required() !!}
              {!! form()->text('email')->label(__('Email'))->required() !!}
              {!! form()->hidden('status')->value('PENGAJUAN') !!}


            {!! form()->action(form()->submit(__('Submit'))) !!}
        {!! form()->close() !!}
        @endif
    </x-volt-panel>
</x-volt-app>
