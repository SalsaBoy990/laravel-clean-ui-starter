<?php

namespace App\Http\Livewire\Admin\Clean\Category;

use App\Interface\Repository\Clean\CategoryRepositoryInterface;
use App\Interface\Services\Clean\ImageServiceInterface;
use App\Models\Clean\Category;
use App\Trait\Clean\InteractsWithBanner;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateRoot extends Component
{
    use InteractsWithBanner;
    use AuthorizesRequests;

    // used by blade / alpinejs
    public string $title;
    public string $modalId;
    public bool $isModalOpen;
    public bool $hasSmallButton;

    // inputs
    public string $name;
    public string $slug;
    public ?string $cover_image_url = '';

    protected array $rules = [
        'name' => 'required|string|min:1|max:255',
        'slug' => 'required|string|unique:categories',
        'cover_image_url' => 'nullable|string',
    ];


    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepository;


    /**
     * @var ImageServiceInterface
     */
    private ImageServiceInterface $imageService;


    /**
     * @param  CategoryRepositoryInterface  $categoryRepository
     * @param  ImageServiceInterface  $imageService
     * @return void
     */
    public function boot(CategoryRepositoryInterface $categoryRepository, ImageServiceInterface $imageService): void
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageService = $imageService;
    }


    public function mount(bool $hasSmallButton)
    {
        $this->title = __('Add category');
        $this->modalId = 'm-new-root';
        $this->hasSmallButton = $hasSmallButton;

        $this->name = '';
        $this->slug = '';
    }


    public function render()
    {
        return view('admin.livewire.clean.category.create-root');
    }


    /**
     * @throws AuthorizationException
     */
    public function createCategory()
    {
        $this->authorize('create', Category::class);

        // validate user input
        $this->validate();


        // save category, rollback transaction if fails
        DB::transaction(
            function () {
                $category = [];
                $category['name'] = $this->name;
                $category['slug'] = $this->slug;

                if (isset($this->cover_image_url)) {
                    $category['cover_image_url'] = $this->imageService->getImageAbsolutePath($this->cover_image_url);
                }

                $category['category_id'] = null;

                $this->categoryRepository->createCategory($category);
            },
            2
        );

        $this->banner(__('New category successfully added.'));
        return redirect()->route('category.manage');
    }

    public function initialize(): void
    {
        $this->name = '';
        $this->cover_image_url = '';
    }
}
