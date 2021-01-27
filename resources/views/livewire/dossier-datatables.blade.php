<x-layout>
  <div class="md:flex">
      <div class="md:justify-center w-full">
            
          
          <div>
                <h2 class="text-black text-4xl leading-10">Search Dossier</h2>
          </div>
            
    
          <div class="w-full">    
            <livewire:dossier-datatables 
                  searchable="project_ref_id, company"
                   exportable
            />
  
          </div>
      </div>
        
  </div>
    
</x-layout>