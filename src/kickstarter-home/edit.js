import {
	useBlockProps,
	RichText,
	MediaUpload,
	MediaUploadCheck
} from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

export default function Edit({ attributes, setAttributes }) {
	const {
		heading,
		description,
		note,
		mainImage,
		bottomImages
	} = attributes;

	const onSelectMainImage = (media) => setAttributes({ mainImage: media.url });

	const onSelectBottomImage = (index, media) => {
		const newImages = [...bottomImages];
		newImages[index] = media.url;
		setAttributes({ bottomImages: newImages });
	};

	return (
		<div {...useBlockProps({ className: 'min-h-screen bg-[#3e305c]' })}>
			<div className="flex">
				{/* Static Left Side Image */}
				<div className="w-[15%] bg-[#3e305c] relative overflow-hidden">
					<div className="absolute inset-0 opacity-20 transform -translate-x-1/4">
					<img
						alt="Static board image"
						src={`${window.location.origin}/wp-content/plugins/switchboard-blocks/assets/images/left-column.png`}
						className="object-cover h-full"
					/>

					</div>
				</div>

				{/* Right Side Content */}
				<div className="w-[85%] p-8">
					<div className="flex flex-col">
						<div className="relative flex flex-col md:flex-row items-center mb-16 pt-8">
							{/* Text Column */}
							<div className="md:w-1/2 text-center md:text-right pr-4 md:pr-12">
								<RichText
									tagName="h1"
									value={heading}
									onChange={(val) => setAttributes({ heading: val })}
									placeholder="Enter heading"
									className="text-3xl md:text-4xl font-bold italic mb-4"
								/>
								<RichText
									tagName="p"
									value={description}
									onChange={(val) => setAttributes({ description: val })}
									placeholder="Enter description"
									className="text-lg mb-6"
								/>
								<RichText
									tagName="p"
									value={note}
									onChange={(val) => setAttributes({ note: val })}
									placeholder="Enter link or note"
									className="text-sm text-gray-300 italic mb-6"
								/>
							</div>

							{/* Main Image */}
							<div className="md:w-1/2 mt-8 md:mt-0 text-center">
								<MediaUploadCheck>
									<MediaUpload
										onSelect={onSelectMainImage}
										allowedTypes={['image']}
										render={({ open }) => (
											<Fragment>
												{mainImage && (
													<img src={mainImage} alt="Main" className="mx-auto mb-4 max-w-full h-auto" />
												)}
												<Button variant="primary" onClick={open}>
													{mainImage ? 'Change Main Image' : 'Upload Main Image'}
												</Button>
											</Fragment>
										)}
									/>
								</MediaUploadCheck>
							</div>
						</div>

						{/* Three Bottom Images */}
						<div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
							{bottomImages.map((img, i) => (
								<div key={i} className="bg-[#2e2345] p-6 text-center">
									<div className="flex flex-col items-center justify-center h-48 bg-[#3e305c] rounded">
										{img && (
											<img src={img} alt={`Image ${i + 1}`} className="w-16 h-16 mb-2" />
										)}
										<MediaUploadCheck>
											<MediaUpload
												onSelect={(media) => onSelectBottomImage(i, media)}
												allowedTypes={['image']}
												render={({ open }) => (
													<Button variant="secondary" onClick={open}>
														{img ? 'Change Image' : 'Upload Image'}
													</Button>
												)}
											/>
										</MediaUploadCheck>
									</div>
								</div>
							))}
						</div>
					</div>
				</div>
			</div>
		</div>
	);
}
